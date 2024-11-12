<?php 
    session_start();
?>
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
        require_once 'admin/conect.php';

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
        $one_page = 6;
        $total_page = ceil($total / $one_page);
        $skip = $one_page * ($page - 1);

        $sql = "SELECT *
                FROM products
                WHERE products.name like '%$search%' 
                LIMIT $one_page
                OFFSET $skip";
        $result = mysqli_query($conect, $sql);
    ?>

    
    
    <div id="tong" class="main">
        Chào mừng bạn đến với thế giới buôn lậu!
        <?php 
            if (isset($_SESSION['id'])) {
                echo 'Chào ' . $_SESSION['name'] . ',';
            }
        ?>
        <?php require_once 'menu.php'; ?>
        <div id="tren">
            
            <?php require_once 'SlideShow/slide.html'; ?>
        </div>
        <caption>
            <form action="">
                Tìm kiếm theo tên
                <input type="search" name="search" id="" value="<?php echo $search?>" placeholder="Nhập gì đó">
            </form>
        </caption>
        <div id="giua">
            <?php foreach ($result as $each) { ?>
                <div class="tung_san_pham">
                    <?php echo $each['name'] ?>
                    <br>
                    <img height="170px" width="200px" src="admin/products/<?php echo $each['photo'] ?>" alt="">
                    <br>
                    <span> Giá:
                        <?php echo $each['price']?>$
                    </span>
                    <br>
                    <a style="color : blue" href="view_detail.php?id=<?php echo $each['id']?>">
                        Xem chi tiết >>>>
                    </a>    
                    <br>              
                    <?php if (isset($_SESSION['id'])) { ?>
                        <button class="btn-add-to-cart" data-id="<?php echo $each['id']?>">
                        Thêm vào giỏ hàng >>>>
                        </button> 
                    <?php }?>
                      
                </div>
            <?php }?>
            

        </div>
        <br><br>
        <div class="pagination">
            <?php for($i = 1; $i <= $total_page; $i++) {?>
                <a class="active" href="?page=<?php echo $i?>&search=<?php echo $search?>">
                    <?php echo $i ?>
                </a>
            <?php }?>
        </div>
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
        <?php require_once 'SlideShow/slide.js'?>
    </script>
</body>
</html>