<?php 
    session_start();
    if (isset($_SESSION['level'])) {
        header('location:root/index.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Đăng nhập admin</h2>
    <form method="post" action="process_login.php">
        Email:
        <input type="email" name="email" id="">
        <br>
        Mật khẩu:
        <input type="password" name="password" id="">
        <br>
        <button>Đăng nhập</button>
    </form>
</body>
</html>