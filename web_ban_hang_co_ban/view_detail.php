<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       *{
			margin: 0;
			padding: 0;
		}
		#tong{
			width: 100%;
			height: 700px;
			background: black;
		}
		#tren{
			width: 100%;
			height: 20%;
			/* background: blue; */
		}
		#giua{
			width: 100%;
			height: 70%;
			background: black;
            text-align: center;
		}
		#duoi{
			width: 100%;
			height: 10%;
			background: purple;
		}
        .tung_san_pham{
            text-align: center;
            width: 33%;
            border: 1px solid black;
            height: 250px;
            float: left;
	    }
        <?php require_once 'SlideShow/slide.css'?>
    </style>
</head>
<body>
    <?php 
        $id = $_GET['id'];
        require_once 'admin/conect.php';
        $sql = "SELECT products.*, manufacturers.name AS manufacturer_name
                FROM products
                JOIN manufacturers
                ON products.manufacturer_id = manufacturers.id
                WHERE products.id = '$id'";
        $tmp = mysqli_query($conect, $sql);
        $result = mysqli_fetch_array($tmp);
    ?>

    <div id="tong" class="main">
        <div id="div_tren">
            <?php require_once 'menu.php'; ?>
        </div>
        <div id="giua">
            <div id="div_ten">
                Tên sản phẩm : <?php echo $result['name']?>
            </div>
            <div id="div_anh">
                <img width="400px" height="200px" src="admin/products/<?php echo $result['photo'] ?>" alt="">
                
            </div>
            
            <div id="div_gia">
                Giá : <?php echo $result['price'] .'$'?>
            </div>
            <div id="div_mo_ta">
                Mô tả :
                <?php echo $result['description']?>
            </div>
            <div id = "div_ten_nsx">
                Tên nhà sản xuất:
                <?php echo $result['manufacturer_name']?>
            </div>
            <?php if (isset($_SESSION['id'])) { ?>
                <button class="btn-add-to-cart" data-id="<?php echo $result['id']?>">
                    Thêm vào giỏ hàng >>>>
                </button> 
            <?php }?>
        </div>
        <br>
        <br>
        <br>
        <br><br>
        <br>
        <br>
        <div id="duoi">
            <?php require_once 'footer.php'; ?>
        </div>
    </div>
    <?php mysqli_close($conect);?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".btn-add-to-cart").click(function () { 
  
                let id = $(this).data('id');
                // alert('Success! id is ' + id);

                $.ajax({
                    type: "GET",
                    url: "add_to_cart.php",
                    data: {id},
                    // dataType: "text",
                    success: function (response) {
                        alert("Thêm thành công!");
                        console.log("response");
                    },
                    error: function (response) {
                        alert("Thêm thất bại!");
                        console.log("response");
                    },
                });
            });
        });
    </script>
</body>
</html>