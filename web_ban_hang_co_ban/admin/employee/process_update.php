<?php require_once '../check_super_admin_login.php';?>
<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    session_start();
    if (!isset($name) || !isset($address) || !isset($phone) || !isset($email) || !isset($password)) {
        header("location:form_update.php?id=%$id");
        $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
        exit;
    }

    require_once('../conect.php');
    $sql = "UPDATE admin
            SET name = '$name', address = '$address', phone = '$phone', email = '$email', password = '$password'
            WHERE id = '$id'";
    mysqli_query($conect, $sql);
    mysqli_close($conect);
    $_SESSION['success'] = 'Sửa thành công!';
    header('location:index.php');