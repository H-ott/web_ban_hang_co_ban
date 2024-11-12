<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .div_loi{
        color: red;
    }
</style>
<body>
    
    <div class="main">
        <?php require_once 'menu.php'?>
        <h1>Đăng ký tài khoản</h1>
        <form method="post" action="signup_process.php">
        Tên :
        <input type="text" name="name" id="name">
        <div id="loi_ten" class="div_loi"></div>
        <br>
        Email :
        <input type="email" name="email" id="email">
        <div id="loi_email" class="div_loi"></div>
        <br>
        Mật khẩu :
        <input type="password" name="password" id="password">
        <div id="loi_mat_khau" class="div_loi"></div>
        <br>
        Giới tính :
        <input type="radio" name="gender" id="" value="0"> Nam
        <input type="radio" name="gender" id="" value="1"> Nữ
        <div id="loi_gioi_tinh" class="div_loi"></div>
        <br>
        Ngày sinh :
        <input type="date" name="date" id="date">
        <div id="loi_ngay_sinh" class="div_loi"></div>
        <br>
        Số điện thoại :
        <input type="number" name="phone" id="phone">
        <div id="loi_so_dien_thoai" class="div_loi"></div>
        <br>
        Địa chỉ :
        <input type="text" name="address" id="address">
        <br>
        <button onclick="return check()">Đăng ký</button>
        </form>
    </div>
    <script>
        function check(){
            //let check = true;
            let ho_ten = document.getElementById("name").value;
            if (ho_ten.length === 0) {
                document.getElementById("loi_ten").innerHTML = "Họ tên không được để trống!"
                check = false;
            }
            //Ktra mật khẩu
            let mat_khau = document.getElementById("password").value;
            let regex_mat_khau = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@.#$!%*?&^])[A-Za-z\d@.#$!%*?&]{8,15}$/gm;
            let result_mat_khau = regex_mat_khau.test(mat_khau);
            if (mat_khau.length === 0) {
                document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không được để trống!"
                check = false;
            } else {
                if (result_mat_khau == false) {
                    document.getElementById("loi_mat_khau").innerHTML = "Mật khẩu không hợp lệ! Mật khẩu phải ít nhất 8 ký tự bao gồm ký tự hoa, thường, số và ký tự đặc biệt!"
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
            //Ktra SĐT
            // let so_dien_thoai = document.getElementById("phone").value;
            // let regex_so_dien_thoai = /^(?:0|\+84)[1-9][0-9]{8}$/gm;
            // let result_so_dien_thoai = regex_so_dien_thoai.test(so_dien_thoai);
            // if (so_dien_thoai.length === 0) {
            //     document.getElementById("loi_so_dien_thoai").innerHTML = "Số điện thoại không được để trống!"
            //     check = false;
            // } else {
            //     if (result_mat_khau == false) {
            //         document.getElementById("loi_so_dien_thoai").innerHTML = "Số điện thoại không hợp lệ!"
            //         check = false;
            //     }
            //     else {
            //         document.getElementById("loi_so_dien_thoai").innerHTML = ""
            //     }
            // }
            //Ktra giới tính
            let mang_gioi_tinh = document.getElementsByName("gender");
            let kt = false;
            for (let i = 0; i < mang_gioi_tinh.length; i++) {
                if (mang_gioi_tinh[i].checked) {
                    kt = true;
                    break;
                }
            }
            if (kt == false) {
                document.getElementById("loi_gioi_tinh").innerHTML = "Không được để trống giới tính";
                check = false;
            }
            else {
                document.getElementById("loi_gioi_tinh").innerHTML = "";
            }

            if (check == !true) {
                return false
            }
        }
    </script>
</body>
</html>