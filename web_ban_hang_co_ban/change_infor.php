<?php 
    session_start();
    require_once 'admin/conect.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * 
            FROM customers
            WHERE id = '$id'";
    $tmp = mysqli_query($conect, $sql);
    $result = mysqli_fetch_array($tmp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <?php require_once 'menu.php';?>
        <table border="1px" width="50%" margin-top="100">
            <form method="post" action="change_infor_process.php">
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
                    <td>Bạn cần nhập mật khẩu để có thể thay đổi những thông tin trên:</td>
                    <td><input type="password" name="password" id=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button>Sửa</button>
                    </td>
                </tr>
   
            </form>
        </table>
        
    </div>
    
</body>
</html>