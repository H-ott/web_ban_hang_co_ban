<?php
        $name_reciver = $_POST['name_reciver'];
        $phone_reciver = $_POST['phone_reciver'];
        $address_reciver = $_POST['address_reciver'];


        require_once 'check_customer_login.php';
        require_once 'admin/conect.php';

        $cart = $_SESSION['cart'];
        $total_price = 0;
        foreach ($cart as $each) {
                $total_price += $each['quantity'] * $each['price'];
        }
        $status = 0;
        $customer_id = $_SESSION['id'];
        $sql = "INSERT INTO orders(customer_id, name_reciver, phone_reciver, address_reciver, status, total_price)
                VALUES ('$customer_id', '$name_reciver', '$phone_reciver', '$address_reciver', '$status', '$total_price') ";
        mysqli_query($conect, $sql);

        $sql = "SELECT MAX(id) FROM orders
                WHERE customer_id = '$customer_id'";
        $tmp = mysqli_query($conect, $sql);
        $order_id = mysqli_fetch_array($tmp)['MAX(id)'];

        foreach ($cart as $product_id => $each) {
                $quantity = $each['quantity'];
                $sql = "INSERT INTO order_product(order_id, product_id, quantity)
                        VALUES ('$order_id', '$product_id', '$quantity')";
                mysqli_query($conect, $sql);
        }
        unset($_SESSION['cart']);
        mysqli_close($conect);
        $_SESSION['success'] = 'Đặt hàng thành công!';
        header('location:cart.php');