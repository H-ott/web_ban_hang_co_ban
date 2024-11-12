<?php require_once '../check_super_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <?php 
        $id = $_GET['id'];
        if ($id == '') {
            header('location:index.php');
        }
        require_once('../conect.php');
        
        $sql = "SELECT * FROM customers
                WHERE id = '$id'";
        $tmp = mysqli_query($conect, $sql);
        $result = mysqli_fetch_array($tmp);
    ?>
    <div class="main">
        <?php require_once('../menu.php');?>
        <table border="1px" width="50%">
            <form method="post" action="process_update.php">
                <input type="hidden" name="id" id="" value="<?php echo $id;?>">
                <tr>
                    <td colspan="2"><h1>Thay đổi thông tin liên hệ</h1></td>
                </tr>
                <tr>
                    <td>Tên:</td>
                    <td><input type="text" name="name" id="" value="<?php echo $result['name']?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" id="" value="<?php echo $result['email']?>"></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type="text" name="phone" id="" value="<?php echo $result['phone']?>"></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type="text" name="address" id="" value="<?php echo $result['address']?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button>Sửa</button>
                    </td>
                </tr>
            </form>
        </table>
    </div>
    <?php 
        mysqli_close($conect);
    ?>
</body>
</html>
