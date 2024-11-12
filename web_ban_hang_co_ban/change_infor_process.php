<?php
    session_start();
    require_once 'admin/conect.php';
    $password = $_POST['password'];
    $id = $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $sql = "SELECT * 
            FROM customers
            WHERE id = '$id' AND password = '$password'";
    $result = mysqli_query($conect, $sql);
    $number_row = mysqli_num_rows($result);
    if ($number_row != 1) {
        $_SESSION['error'] = 'Mật khẩu không hợp lệ!';
        header('location:change_infor.php');
        exit;
    }
    $sql = "UPDATE customers
            SET name = '$name',
                phone = '$phone',
                email = '$email',
                address = '$address'
            WHERE id = '$id' AND password = '$password'";
    mysqli_query($conect, $sql);
    $_SESSION['success'] = 'Đổi thông tin thành công!';
    header('location:user.php');