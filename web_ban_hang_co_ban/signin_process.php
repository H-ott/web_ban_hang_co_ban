<?php
    require_once 'admin/conect.php';
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM customers
            WHERE email = '$email' AND password = '$password'";
    $tmp = mysqli_query($conect, $sql);
    $number_row = mysqli_num_rows($tmp);
    $result = mysqli_fetch_array($tmp);
    if ($number_row != 1) {      
        $_SESSION['error'] = 'Email hoặc mật khẩu sai!';
        header('location:signin_form.php');
        exit;
    }
    $_SESSION['name'] = $result['name'];
    $_SESSION['id'] = $result['id'];
    $id = $result['id'];
    if (isset($_POST['remember'])) {
        $token = uniqid('user_', true);
        $sql = "UPDATE customers
                SET token = '$token'
                WHERE id = '$id'";
        mysqli_query($conect, $sql);
        setcookie('remember', $token, time() + 60*60*24*30);
    } 
    $_SESSION['success'] = 'Đăng nhập thành công!';
    header('location:user.php');
    mysqli_close($conect);
    
   