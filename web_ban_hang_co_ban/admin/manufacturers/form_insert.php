<?php require_once '../check_super_admin_login.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="main">
        <?php require_once '../menu.php'?>
        Thêm nhà sản xuất 
        <form method="post" action="process_insert.php" enctype="multipart/form-data">
            Tên : 
            <input type="text" name="name" id=""> <br>
            Địa chỉ :
            <textarea name="address" id=""></textarea><br>
            SĐT :
            <input type="text" name="phone" id=""> <br>
            Ảnh :
            <input type="file" name="photo" id="">
            <br>
            <button>Thêm</button>
        </form>
    </div>
</body>
</html>
