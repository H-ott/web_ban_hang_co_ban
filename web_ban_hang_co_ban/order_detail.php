<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once 'check_customer_login.php';
        require_once 'admin/conect.php';
        $order_id = $_GET['id'];
        $sql = "SELECT 
                    order_product.*, 
                    products.*, 
                    orders.address_reciver AS address_reciver,
                    orders.total_price AS total_price,
                    orders.created_at AS created_at 
                FROM order_product 
                JOIN orders 
                ON order_product.order_id = orders.id 
                JOIN products 
                ON order_product.product_id = products.id 
                WHERE order_id = '$order_id';";
        $result = mysqli_query($conect, $sql);
        $price = mysqli_fetch_array($result);
        $i = 1;
    ?>
    <div class="main">
        <?php require_once 'menu.php';?>
        <h1>Hoá đơn chi tiết</h1>
        <table border="1px" width="100%">
            <tr>
                <td>STT</td>
                <td>Tên sản phẩm</td>
                <td>Ảnh</td>
                <td>Số lượng</td>
                <td>Mô tả</td>
                <td>Ngày đặt</td>
                <td>Giá</td>
                <td>Địa chỉ nhận</td>
            </tr>
            <?php foreach ($result as $each) {?>
                <tr>
                    <td><?php echo "$i"; $i++?></td>
                    <td><?php echo $each['name']?></td>
                    <td>
                        <img width="100px" src="admin/products/<?php echo $each['photo']?>" alt="">
                    </td>
                    <td>
                        <?php echo $each['quantity']?>
                    </td>
                    <td><?php echo $each['description']?></td>
                    <td><?php echo $each['created_at']?></td>
                    <td><?php echo $each['price']?></td>
                    <td><?php echo $each['address_reciver']?></td>
                </tr>
            <?php }?>
        </table>
        <h1>Tổng hoá đơn $<?php echo $price['total_price']?></h1>
    </div>
</body>
</html>
