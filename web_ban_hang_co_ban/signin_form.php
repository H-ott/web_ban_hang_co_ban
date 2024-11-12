<?php 
    session_start();
    require_once 'admin/conect.php';
     
    if (isset($_COOKIE['remember'])) {
        $token = $_COOKIE['remember'];
        $sql = "SELECT * FROM customers
                WHERE token = '$token'";
        $tmp = mysqli_query($conect, $sql);
        $result = mysqli_fetch_array($tmp);
        
        $_SESSION['id'] = $result['id']; 
        $_SESSION['name'] = $result['name'];
    }
    if (isset($_SESSION['id']) || isset($_SESSION['name'])) {
        header('location:user.php');
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .div_loi{
            color: red;
        }
    </style>
</head>
<body>
    <div class="main">
        <h1>Đăng nhập</h1>
        <?php require_once 'menu.php'; ?>
        <form method="post" action="signin_process.php">
            Email:
            <input type="email" name="email" id="email">
            <div id="loi_email" class="div_loi"></div>
            <br>
            Mật khẩu:
            <input type="password" name="password" id="password">
            <div id="loi_mat_khau" class="div_loi"></div>
            <br>
            Ghi nhớ đăng nhập
            <input type="checkbox" name="remember" id="">
            <br>
            <button onclick="return check()">Đăng nhập</button>
        </form>
    </div>
    <script>
        function check() {
            // Kiểm tra password
            let mat_khau = document.getElementById("password").value;
            let regex_mat_khau = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&^])[A-Za-z\d@.#$!%*?&]{8,15}$/gm;
            let result_mat_khau = regex_mat_khau.test(mat_khau);
            if (mat_khau.length === 0) {
                document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không được để trống!"
                check = false;
            } else {
                if (result_mat_khau == false) {
                    document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không hợp lệ!"
                    check = false;
                }
                else {
                    document.getElementById("loi_mat_khau").innerHTML = ""
                }
            }
            //Ktra Email
            let email = document.getElementById("email").value;
            if (email.length === 0) {
                document.getElementById("loi_email").innerHTML = "Email không được để trống!"
                check = false;
            } 
            else {
                document.getElementById("loi_email").innerHTML = ""
            } 
            if (check == !true) {
                return false
            }
        }
    </script>
</body>
</html>