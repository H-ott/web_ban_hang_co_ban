<?php require_once '../check_super_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        Đây là giao diện quản lý nhân viên
        <br>
        <?php 
            require_once('../menu.php');
            require_once('../conect.php');
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
                                FROM admin
                                WHERE level = 0 AND name like '%$search%'";
            $result = mysqli_query($conect, $sql_total);
            $total = mysqli_fetch_array($result)['COUNT(*)'];
            $one_page = 3;
            $total_page = ceil($total / $one_page);
            $skip = $one_page * ($page - 1);

            $sql = "SELECT *
                    FROM admin
                    WHERE level = 0 AND name like '%$search%' 
                    LIMIT $one_page
                    OFFSET $skip";
            $result = mysqli_query($conect, $sql);
            /////////////////
        ?>
        <table border="1px" width="100%">
            <a href="form_insert.php">Thêm</a>
            <caption>
                <form action="">
                    Tìm kiếm theo tên
                    <input type="search" name="search" id="">
                </form>
            </caption>
            <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Email</th>
                <th>Mật khẩu</th>
                <th>Sửa</th>
                <th>Xoá</th>
            </tr>
            
            <?php foreach ($result as $each) {?>
                <tr>
                    <td>
                        <?php echo $each['id']?>
                    </td>
                    <td>
                        <?php echo $each['name']?>
                    </td>
                    <td>
                        <?php echo $each['phone']?>
                    </td>
                    <td>
                        <?php echo $each['address']?>
                    </td> 
                    <?php if ($each['gender'] == 1) { ?>
                        <td>
                            Nữ
                        </td>
                    <?php } else {?>
                        <td>
                            Nam
                        </td>
                        <?php }?>
                    <td>
                        <?php echo $each['date']?>
                    </td> 
                    <td>
                        <?php echo $each['email']?>
                    </td> 
                    <td>
                        <?php echo $each['password']?>
                    </td> 
                    <td>
                        <a href="form_update.php?id=<?php echo $each['id'];?>">Sửa</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $each['id'];?>">Xoá</a>
                    </td>
                    
                </tr>
            <?php }?>
        </table>
        <?php for($i = 1; $i <= $total_page; $i++) {?>
            <a href="?page=<?php echo $i?>&search=<?php echo $search?>">
                <?php echo $i ?>
            </a>
        <?php }?>
        <?php mysqli_close($conect);?>
    </div>
</body>
</html>
</body>
</html>