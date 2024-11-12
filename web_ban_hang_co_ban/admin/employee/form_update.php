<?php require_once '../check_super_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="main">
        <?php 
            $id = $_GET['id'];
            if ($id == '') {
                header('location:index.php');
            }
            require_once('../conect.php');
            require_once '../menu.php';
            $sql = "SELECT * FROM admin
                    WHERE id = '$id'";
            $tmp = mysqli_query($conect, $sql);
            $result = mysqli_fetch_array($tmp);
        ?>
        Sửa thông tin 
        <form method="post" action="process_update.php">
            <input type="hidden" name="id" id="" value="<?php echo $result['id'] ?>">
            Tên : 
            <input type="text" name="name" id="" value="<?php echo $result['name']?>"> <br>
            SĐT : 
            <input type="text" name="phone" id="" value="<?php echo $result['phone']?>"> <br>
            Địa chỉ :
            <textarea name="address" id="" >
                <?php echo $result['address']?>
            </textarea><br>
            Email :
            <input type="text" name="email" id="" value="<?php echo $result['email']?>"> <br>
            Mật khẩu :
            <input type="text" name="password" id="" value="<?php echo $result['password']?>"> <br>
            <br>
            <button>Sửa</button>
        </form>
        <?php 
            mysqli_close($conect);
        ?>
    </div>
</body>
</html>
