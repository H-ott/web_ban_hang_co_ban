<?php require_once '../check_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <?php 
            require_once '../menu.php';
            require_once '../conect.php';
            $sql = "SELECT orders.*, 
                        customers.name AS name_customer, 
                        customers.phone AS phone_customer, 
                        customers.address AS address_customer
                    FROM orders
                    JOIN customers
                    ON orders.customer_id = customers.id";
            $result = mysqli_query($conect, $sql);
            
        ?>
        <h1>Quản lý hoá đơn</h1>
        <table border="1px" width="100%">
            <tr>
                <td>Mã</td>
                <td>Thời gian đặt</td>
                <td>Thông tin người nhận</td>
                <td>Thông tin người đặt</td>
                <td>Trạng thái</td>
                <td>Tổng tiền</td>
                <td>Duyệt</td>
                <td>Huỷ</td>
                <td>Hoàn tác</td>
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
                        <?php if ($each['status'] == 0) {?>
                            <a href="update_status_process.php?id=<?php echo $each['id']?>&status=accept">Duyệt</a>
                        <?php }?>
                    </td>
                    <td>
                        <?php if ($each['status'] == 0) {?>
                            <a href="update_status_process.php?id=<?php echo $each['id']?>&status=cancel">Huỷ</a>
                        <?php }?>
                    </td>
                    <td>
                    <a href="update_status_process.php?id=<?php echo $each['id']?>&status=undo">Hoàn tác</a>
                    </td>
                    <td>
                        <a href="order_detail.php?id=<?php echo $each['id']?>">Xem chi tiết</a>
                    </td>
                </tr>
            <?php }?>
        </table>
        <?php mysqli_close($conect)?>
    </div>
</body>
</html>