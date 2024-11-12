<?php require_once '../check_admin_login.php';?>
<?php
    require_once '../conect.php';
    $id = $_GET['id'];
    $status = $_GET['status'];
    if ($status == 'accept') {
        $sql = "UPDATE orders
            SET status = '1'
            WHERE id = '$id'";
        mysqli_query($conect, $sql);
        session_start();
        $_SESSION['success'] = 'Duyệt thành công';
        header('location:index.php');
        mysqli_close($conect);
        exit;
    }
    else if ($status == 'cancel'){
        $sql = "UPDATE orders
            SET status = '2'
            WHERE id = '$id'";
        mysqli_query($conect, $sql);
        session_start();
        $_SESSION['success'] = 'Huỷ thành công';
        header('location:index.php');
        mysqli_close($conect);
        exit;
    }
    else {
        $sql = "UPDATE orders
            SET status = '0'
            WHERE id = '$id'";
        mysqli_query($conect, $sql);
        session_start();
        $_SESSION['success'] = 'Hoàn tác thành công';
        header('location:index.php');
        mysqli_close($conect);
        exit;
    }
    
    
    