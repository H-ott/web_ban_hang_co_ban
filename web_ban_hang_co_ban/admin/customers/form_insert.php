<?php require_once '../check_super_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <?php require_once '../menu.php'?>
        <h1>Thêm nhân viên</h1>
        <form method="post" action="process_insert.php">
        Tên :
        <input type="text" name="name" id="">
        <br>
        Email :
        <input type="email" name="email" id="">
        <br>
        Mật khẩu :
        <input type="password" name="password" id="">
        <br>
        Giới tính :
        <input type="radio" name="gender" id="" value="0"> Nam
        <input type="radio" name="gender" id="" value="1"> Nữ
        <br>
        Ngày sinh :
        <input type="date" name="date" id="">
        <br>
        Số điện thoại :
        <input type="number" name="phone" id="">
        <br>
        Địa chỉ :
        <input type="text" name="address" id="">
        <br>
        <button>Thêm</button>
        </form>
    </div>
</body>
</html>