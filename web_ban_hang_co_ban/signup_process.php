<?php
    require 'admin/conect.php';
    session_start();
    $email = addslashes($_POST['email']);
    $sql = "SELECT * FROM customers
            WHERE email = '$email'";
    $result = mysqli_query($conect, $sql);
    $number_row = mysqli_num_rows($result);
    if ($number_row >= 1) {
        $_SESSION['error'] = 'Email không tồn tại hoặc đã được đăng ký.';
        header('location:signup_form.php');
        exit;
    }

    $name = addslashes($_POST['name']);
    $password = addslashes($_POST['password']);
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql_insert = "INSERT INTO customers (name, email, password, gender, date, phone, address, token)
                   VALUES ('$name', '$email', '$password', '$gender', '$date', '$phone', '$address', null)";
    mysqli_query($conect, $sql_insert);
    $_SESSION['success'] = 'Đăng ký thành công! Đăng nhập để sử dụng dịch vụ của chúng tôi.';

    // Gửi mail
    // $to = "nguyendinhhoang003@gmail.com";
    // $subject = "My subject";
    // $txt = "Hello world!";
    // $headers = "From: webmaster@example.com" . "\r\n";

    // mail($to,$subject,$txt,$headers);

    header('location:signin_form.php');
    mysqli_close($conect);