<?php require_once '../check_admin_login.php';?>
<?php 
    require_once '../conect.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM products
            WHERE id = '$id'";
    mysqli_query($conect, $sql);
    session_start();
    $_SESSION['success'] = 'Xoá thành công!';
    header('location:index.php');
    mysqli_close($conect);