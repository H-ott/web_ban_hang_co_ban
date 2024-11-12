<?php 
    session_start();
    if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) {
        header('location:signin_form.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .main {
  padding: 16px;
  margin-top: 30px;
  height: auto; /* Used in this example to enable scrolling */
}
</style>
<body>
    <div class="main">

    
        <?php 
            require_once 'menu.php';
            require_once 'admin/conect.php';
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM customers
                    WHERE id = '$id'";
            $tmp = mysqli_query($conect, $sql);
            $result = mysqli_fetch_array($tmp);
        ?>
        <h1>Đây là trang người dùng</h1>
        Chào 
        <?php
            echo $_SESSION['name'];
        ?>
        .Chào mừng quay trở lại!

        <table border="1px" width="100%">
            <tr>
                <td colspan="2"><h1>Thông tin cá nhân</h1></td>
            </tr>
            <tr>
                <td>Tên :</td>
                <td><?php echo $result['name']?></td>
            </tr>
            <tr>
                <td>Giới tính :</td>
                <td><?php if($result['gender'] == 0) echo "Nam"; else {echo "Nữ";}?></td>
            </tr>
            <tr>
                <td>Ngày sinh :</td>
                <td><?php echo $result['date']?></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><?php echo $result['email']?></td>
            </tr>
            <tr>
                <td>Số điện thoại :</td>
                <td><?php echo $result['phone']?></td>
            </tr>
            <tr>
                <td>Địa chỉ :</td>
                <td><?php echo $result['address']?></td>
            </tr>
        </table>   
    </div>
</body>
</html>