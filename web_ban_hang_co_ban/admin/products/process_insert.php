<?php require_once '../check_admin_login.php';?>
<?php
require_once '../conect.php';
$name = $_POST['name'];
$photo = $_FILES['photo'];
$price = $_POST['price'];
$description = $_POST['description'];
$manufacturer_id = $_POST['manufacturer_id'];



$target_dir = "photos/";
$target_file = $target_dir . basename($photo["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

session_start();
if (empty($name) || empty($target_file) || empty($price) || empty($description)) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
    header("location:form_insert.php");
    exit;
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($photo["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
// if ($photo["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($photo["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $photo["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$sql = "INSERT INTO products(name, photo, price, description, manufacturer_id)
        VALUES ('$name', '$target_file', '$price', '$description','$manufacturer_id')";
mysqli_query($conect, $sql);
$_SESSION['success'] = 'Thêm thành công!';
header('location:index.php');
mysqli_close($conect);