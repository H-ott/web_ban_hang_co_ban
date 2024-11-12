<?php
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['name']);
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    setcookie('remember', null, -1);
    header('location:index.php');
