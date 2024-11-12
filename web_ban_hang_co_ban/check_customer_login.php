<?php 
    session_start();
    if (!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        $_SESSION['error'] = 'Bạn cần đăng nhập để thực hiện chức năng này!';
        header('location:signin_form.php');
        exit;
    }