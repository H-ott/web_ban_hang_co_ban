<?php require_once '../check_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>
    <div class="main">
        Quản lý sản phẩm
        <?php 
            require_once '../menu.php';
            require_once '../conect.php';

            // Tìm kiếm và phân trang
            $page = 1;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }

            $search = '';
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            }
            $sql_total = "SELECT COUNT(*)
                                FROM products
                                WHERE name like '%$search%'";
            $result = mysqli_query($conect, $sql_total);
            $total = mysqli_fetch_array($result)['COUNT(*)'];
            $one_page = 3;
            $total_page = ceil($total / $one_page);
            $skip = $one_page * ($page - 1);

            $sql = "SELECT products.*, manufacturers.name AS manufacturer_name
                    FROM products
                    JOIN manufacturers
                    ON products.manufacturer_id = manufacturers.id
                    WHERE products.name like '%$search%' 
                    LIMIT $one_page
                    OFFSET $skip";
            $result = mysqli_query($conect, $sql);
            //////////////////
            
        ?>
        <a href="form_insert.php">
            Thêm sản phẩm
        </a>
        <table border="1px" width="100%">
            <caption>
                <form action="">
                    Tìm kiếm theo tên
                    <input type="search" name="search" id="">
                </form>
            </caption>
            <tr>
                <td>
                    Mã
                </td>
                <td>
                    Tên sản phẩm
                </td>
                <td>
                    Ảnh
                </td>
                <td>
                    Giá
                </td>
                <td>
                    Mô tả
                </td>
                <td>
                    Tên nhà sản xuất
                </td>
                <td>
                    Sửa
                </td>
                <td>
                    Xoá
                </td>
            </tr>
            <?php foreach ($result as $each) { ?>
                <tr>
                    <td>
                        <?php echo $each['id']?>
                    </td>
                    <td>
                        <?php echo $each['name']?>
                    </td>
                    <td>
                        <img width="100px" src="<?php echo $each['photo']?>" alt=""> 
                    </td>
                    <td>
                        <?php echo $each['price']?>
                    </td>
                    <td>
                        <?php echo $each['description']?>
                    </td>
                    <td>
                        <?php echo $each['manufacturer_name']?>
                    </td>
                    <td>
                        <a href="form_update.php?id=<?php echo $each['id']?>">Sửa</a>   
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $each['id']?>">Xoá</a>   
                    </td>
                    
                </tr>
            <?php }?>
        </table>
        <?php for($i = 1; $i <= $total_page; $i++) {?>
            <a href="?page=<?php echo $i?>&search=<?php echo $search?>">
                <?php echo $i ?>
            </a>
        <?php }?>
        <?php 
            mysqli_close($conect);
        ?>
    </div>
</body>
</html>