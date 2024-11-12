<?php require_once '../check_super_admin_login.php';?>
<?php
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    if (empty($name) || empty($address) || empty($phone) || empty($email)) {
        $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
        header("location:form_update.php?id=$id");
        exit;
    }

    require_once('../conect.php');
    $sql = "UPDATE customers
            SET name = '$name', address = '$address', phone = '$phone', email = '$email'
            WHERE id = '$id'";
    mysqli_query($conect, $sql);
    mysqli_close($conect);
    $_SESSION['success'] = 'Sửa thành công!';
    header('location:index.php');