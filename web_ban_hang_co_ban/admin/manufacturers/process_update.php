<?php require_once '../check_super_admin_login.php';?>
<?php
    require_once '../conect.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $photo = $_FILES['photo'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $photo_old = $_POST['photo_old'];

    if (empty($name) || empty($photo) || empty($phone) || empty($address)) {
        $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
        header("location:form_update.php?id=$id");
        exit;
    }
    if ($photo['size'] > 0) {
        $target_dir = "photos/";
        $target_file = $target_dir . basename($photo["name"]);
        // die(basename($photo["name"]));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($photo["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $_SESSION['error'] = 'Không phải là file ảnh';
                header('location:index.php');
                $uploadOk = 0;
                exit;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            // $_SESSION['error'] = 'Xin lỗi, file ảnh đã tồi tại';
            // header('location:index.php');
            // $uploadOk = 0;
            // exit;
        }

        // Check file size
        // if ($photo["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        //     header('location:index.php?error=Chỉ file dạng JPG, JPEG, PNG GIF mới được chấp nhận');
        //     $uploadOk = 0;
        //     exit;
        // }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['error'] = 'Xin lỗi file của bạn không được tải lên';
            header('location:index.php');
            exit;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                $sql = "UPDATE manufacturers
                SET name = '$name', address = '$address', phone = '$phone', photo = '$target_file'
                WHERE id = '$id'";
                mysqli_query($conect, $sql);
                $_SESSION['success'] = 'Sửa thành công!';
                header('location:index.php');
            } else {
                $_SESSION['error'] = 'Lỗi tải ảnh lên';
                header('location:index.php');
                exit;
            }
        }
    }
    else $target_file = $photo_old;
    

    $sql = "UPDATE manufacturers
            SET name = '$name', address = '$address', phone = '$phone', photo = '$target_file'
            WHERE id = '$id'";
    mysqli_query($conect, $sql);
    $_SESSION['success'] = 'Sửa thành công!';
    header('location:index.php');
    mysqli_close($conect);