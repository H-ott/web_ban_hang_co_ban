<?php require_once '../check_super_admin_login.php';?>
<?php
    require '../conect.php';

    $email = addslashes($_POST['email']);
    $sql = "SELECT * FROM admin
            WHERE email = '$email'";
    $result = mysqli_query($conect, $sql);
    $number_row = mysqli_num_rows($result);
    if ($number_row >= 1) {
        header('location:form_insert.php?error=Email không tồn tại hoặc đã được đăng ký');
        exit;
    }

    $level = 0;
    $name = addslashes($_POST['name']);
    $password = addslashes($_POST['password']);
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    session_start();
    if (empty($name) || empty($password) || empty($date) || empty($gender) || empty($phone) || empty($address)) {
        $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
        header("location:form_insert.php.php");
        exit;
    }

    $sql_insert = "INSERT INTO admin (name, email, password, gender, date, phone, address, level)
                   VALUES ('$name', '$email', '$password', '$gender', '$date', '$phone', '$address', $level)";
    mysqli_query($conect, $sql_insert);
    $_SESSION['success'] = 'Thêm thành công!';
    header('location:index.php');

    mysqli_close($conect);