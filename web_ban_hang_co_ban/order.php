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
        require_once 'menu.php';
        require_once 'admin/conect.php';
        $id = $_SESSION['id'];
        $sql = "SELECT orders.*, 
                    customers.name AS name_customer, 
                    customers.phone AS phone_customer, 
                    customers.address AS address_customer
                FROM orders
                JOIN customers
                ON orders.customer_id = customers.id
                WHERE customers.id = $id";
        $result = mysqli_query($conect, $sql);
        
    ?>
    <div class="main">
        <h1>Quản lý hoá đơn</h1>
        <table border="1px" width="100%">
            <tr>
                <td>Mã</td>
                <td>Thời gian đặt</td>
                <td>Thông tin người nhận</td>
                <td>Thông tin người đặt</td>
                <td>Trạng thái</td>
                <td>Tổng tiền</td>
                <td>Xem chi tiết</td>
            </tr>
            <?php foreach ($result as $each) {?>
                <tr>
                    <td><?php echo $each['id']?></td>
                    <td><?php echo $each['created_at']?></td>
                    <td>
                        <?php echo $each['name_reciver']?>
                        <?php echo $each['phone_reciver']?>
                        <?php echo $each['address_reciver']?>
                    </td>
                    <td>
                        <?php echo $each['name_customer']?>
                        <?php echo $each['phone_customer']?>
                        <?php echo $each['address_customer']?>
                    </td>
                    <?php if ($each['status'] == 0) {?>
                        <td>
                            Vừa đặt
                        </td>
                    <?php } else if($each['status'] == 1){?>
                        <td>
                        Đã duyệt
                        </td>
                    <?php } else if($each['status'] == 2){?>
                        <td>
                        Đã huỷ
                        </td>
                    <?php } ?>
                    <td>
                        <?php echo '$' . $each['total_price']?>
                    </td>
                    <td>
                        <a href="order_detail.php?id=<?php echo $each['id']?>">Xem chi tiết</a>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
    <?php mysqli_close($conect)?>
</body>
</html>