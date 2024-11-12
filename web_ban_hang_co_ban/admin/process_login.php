<?php
    require_once 'conect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin
            WHERE email = '$email' and password = '$password'";
    $tmp = mysqli_query($conect, $sql);
    $num_row = mysqli_num_rows($tmp);
    if ($num_row != 1) {
        header('location:index.php');
        exit;
    }
    session_start();
    $result = mysqli_fetch_array($tmp);
    $_SESSION['id'] = $result['id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['level'] = $result['level'];
    header('location:root/index.php');

