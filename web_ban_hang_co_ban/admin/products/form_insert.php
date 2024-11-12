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

            $sql = "SELECT * FROM manufacturers";
            $result = mysqli_query($conect, $sql);
        ?>
        Nhập thông tin sản phẩm
        <form method="post" action="process_insert.php" enctype="multipart/form-data">
            Tên sản phẩm :
            <input type="text" name="name" id="" >
            <br>
            Ảnh : 
            <input type="file" name="photo" id="">
            <br>
            Giá :
            <input type="text" name="price" id="">
            <br>
            Mô tả sản phẩm :
            <textarea name="description" id="">

            </textarea>
            <br>
            Nhà sản xuất :
            <select name="manufacturer_id" id="">
                <?php foreach ($result as $each) {?>
                    <option value="<?php echo $each['id'] ?>">
                        <?php echo $each['name'] ?>
                    </option>
                <?php }?>
            </select>
            <button type="button">Khác</button>
            <br>
            <button>Thêm</button>
        </form>
        <?php 
            mysqli_close($conect);
        ?>
    </div>
</body>
</html>