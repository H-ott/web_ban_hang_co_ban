<?php 
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">    
        <?php require_once 'menu.php'; ?>
        <h1>Đổi mật khẩu</h1>
        <form method="post" action="change_password_process.php">
            Mật khẩu cũ:
            <input type="password" name="old_password" id="">
            <br>
            Mật khẩu mới:
            <input type="password" name="new_password" id="new_password">
            <div id="loi_mat_khau" style="color : red"></div>
            <button onclick="return check()">Thay đổi</button>
        </form>
    </div>

    <script>
        function check() {
            // Kiểm tra password
            let mat_khau = document.getElementById("new_password").value;
            let regex_mat_khau = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&^])[A-Za-z\d@.#$!%*?&]{8,15}$/gm;
            let result_mat_khau = regex_mat_khau.test(mat_khau);
            if (mat_khau.length === 0) {
                document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không được để trống!"
                check = false;
            } else {
                if (result_mat_khau === false) {
                    document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không hợp lệ!"
                    check = false;
                }
                else {
                    document.getElementById("loi_mat_khau").innerHTML = ""
                }
            }
            if (check == !true) {
                return false
            }
        }
    </script>
</body>
</html>