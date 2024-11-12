<?php
    session_start();
    require_once 'admin/conect.php';

    $id = $_SESSION['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT * 
            FROM customers
            WHERE id = '$id' AND password = '$old_password'";
    $result = mysqli_query($conect, $sql);
    $number_row = mysqli_num_rows($result);
    if ($number_row != 1) {
        $_SESSION['error'] = 'Mật khẩu cũ không hợp lệ!';
        header('location:change_password.php');
        exit;
    }
    $sql = "UPDATE customers
            SET password = '$new_password'
            WHERE id = '$id'";
    mysqli_query($conect, $sql);
    $_SESSION['success'] = 'Đổi mật khẩu thành công!';
    header('location:user.php');

    