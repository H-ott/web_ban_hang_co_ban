<?php require_once '../check_super_admin_login.php';?>
<?php
    $id = $_GET['id'];
    if ($id == '') {
        header('location:index.php');
    }
    require_once('../conect.php');
    $sql = "DELETE FROM customers
            WHERE id = $id";
    mysqli_query($conect, $sql);
    
    mysqli_close($conect);
    $_SESSION['success'] = 'Xoá thành công!';
    header('location:index.php');