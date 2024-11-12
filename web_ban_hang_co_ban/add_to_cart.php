<?php
    require_once 'check_customer_login.php';
    require_once 'admin/conect.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM products
            WHERE id = '$id'";
    $tmp = mysqli_query($conect, $sql);
    $result = mysqli_fetch_array($tmp);
    
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['name'] = $result['name'];
        $_SESSION['cart'][$id]['photo'] = $result['photo'];
        $_SESSION['cart'][$id]['price'] = $result['price'];
        $_SESSION['cart'][$id]['quantity'] = 1;
    }
    else {
        $_SESSION['cart'][$id]['quantity']++;
    }
    print_r($_SESSION['cart']);
    mysqli_close($conect);