<?php 
    require_once 'check_customer_login.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <h1>Đây là giỏ hàng của bạn</h1>
    <?php require_once 'menu.php';?>
    <?php if (!isset($_SESSION['cart'])) {
        echo 'Giỏ hàng trống';
        exit;
    }?>
    
    <table border="1px" width="100%">
        <tr>
            <td>Ảnh</td>
            <td>Tên</td>
            <td>Số lượng</td>
            <td>Giá</td>
            <td>Tổng</td>
        </tr>
        <?php $total_price = 0;?>
        <?php foreach ($_SESSION['cart'] as $key => $value) {?>
            <tr>
                <td>
                    <img width="100px" src="admin/products/<?php echo $value['photo']?>" alt="">
                </td>
                 <td>
                    <?php echo $value['name']?>
                </td>   
                <td>
                    <button 
                        class="btn-update-quantity" 
                        data-id="<?php echo $key?>"
                        data-type="0">
                        -
                    </button>
                    <span class="span-quantity">
                        <?php echo $value['quantity']?>
                    </span>
                    <button 
                        class="btn-update-quantity" 
                        data-id="<?php echo $key?>"
                        data-type="1">
                        +
                    </button>
                </td> 
                <td>
                    <span class="span-price">
                        <?php echo $value['price']?>
                    </span>
                    <?php $total_price += $value['quantity'] * $value['price'];?>
                </td>
                <td>
                    <span class="span-sum">
                        <?php echo $value['quantity'] * $value['price']?>
                    </span>
                </td>
            </tr>

                
        <?php }?>
    </table>
    <h2>
        Tổng tiền : $
        <span class="span-total-price">
            <?php echo $total_price?>
        </span>
    </h2>
    <h3>Thông tin người nhận:</h3>
    <?php 
        $id = $_SESSION['id'];
        require_once 'admin/conect.php';
        $sql = "SELECT * FROM customers
                WHERE id = '$id'";
        $tmp = mysqli_query($conect, $sql);
        $result = mysqli_fetch_array($tmp);
    ?>
    <form method="post" action="process_checkout.php">
        Tên người nhận:
        <input type="text" name="name_reciver" id="" value="<?php echo $result['name']?>">
        <br>
        Số điện thoại:
        <input type="number" name="phone_reciver" id="" value="<?php echo $result['phone']?>">
        <br>
        Địa chỉ người nhận:
        <input type="text" name="address_reciver" id="" value="<?php echo $result['address']?>">
        <br>
        <button class="btn-checkout">
            Đặt hàng
        </button>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".btn-update-quantity").click(function () { 
                let btn = $(this);
                let id = btn.data('id');
                let type = btn.data('type');
                $.ajax({
                    type: "GET",
                    url: "update_quantity.php",
                    data: {id, type},
                    // dataType: "dataType",
                    success: function (response) {
                            let parent_tr = btn.parents('tr');
                            let price = parent_tr.find('.span-price').text();
                            let quantity = parent_tr.find('.span-quantity').text();
                            if (type === 1) {
                                quantity++;
                            }
                            else {
                                quantity--;
                                if (quantity === 0) {
                                    btn.parents('tr').remove();
                                }
                            }
                            parent_tr.find('.span-quantity').text(quantity);
                            parent_tr.find('.span-sum').text(quantity * price);
                            let total_price = 0;
                            $(".span-sum").each(function() {
                                total_price += parseFloat($(this).text());
                            });
                            $(".span-total-price").text(total_price);
                       
                        // alert("Tăng thành công!")text
                    },
                    error: function (response) {
                        alert("Thất bại, Thử lại sau ít phút!")
                    }
                });
            });

        });
    </script>
</body>
</html>