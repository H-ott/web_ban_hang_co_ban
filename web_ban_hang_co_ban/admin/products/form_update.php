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
            $id = $_GET['id'];

            $sql_products = "SELECT * FROM products
                    WHERE id = '$id'";
            $tmp = mysqli_query($conect, $sql_products);
            $result_products = mysqli_fetch_array($tmp);

            $sql_manufacturers = "SELECT * FROM manufacturers";
            $result_manufacturers = mysqli_query($conect, $sql_manufacturers);
        ?>
        Nhập thông tin sản phẩm
        <form method="post" action="process_update.php" enctype="multipart/form-data">
            <input type="hidden" name="id" id="" value="<?php echo $result_products['id'];?>">
            Tên sản phẩm :
            <input type="text" name="name" id="" value="<?php echo $result_products['name'];?>">
            <br>
            Ảnh cũ: 
            <img width="100px" src="<?php echo $result_products['photo']?>" alt="">
            <input type="hidden" name="photo_old" id="" value="<?php echo $result_products['photo']?>">
            Chọn ảnh mới:
            <input type="file" name="photo" id="" value="">
            <br>
            Giá :
            <input type="text" name="price" id="" value="<?php echo $result_products['price'];?>">
            <br>
            Mô tả sản phẩm :
            <br>
            <textarea name="description" id="">
                <?php echo $result_products['description'];?>
            </textarea>
            <br>
            Nhà sản xuất :
            <select name="manufacturer_id" id="">
                <?php foreach ($result_manufacturers as $each) {?>
                    <?php if ($each['id'] == $result_products['manufacturer_id']) {?>
                        <option selected value="<?php echo $each['id'] ?>">
                            <?php echo $each['name'] ?>
                        </option>
                    <?php } else {?>
                    <option value="<?php echo $each['id'] ?>">
                        <?php echo $each['name'] ?>
                    </option>
                    <?php }
                }?>
            </select>
            <button type="button">Khác</button>
            <br>
            <button>Sửa</button>
        </form>
        <?php 
            mysqli_close($conect);
        ?>
    </div>
</body>
</html>