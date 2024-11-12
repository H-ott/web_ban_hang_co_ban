<style>
    <?php require_once 'fixed_menu.css';?>
</style>
<ul>
    <?php if ($_SESSION['level'] == 1) {?>
        <div class="navbar">
            <a href="../index.php">
                Trang chủ
            </a>  
            <a href="../manufacturers">
                Quản lý nhà sản xuất
            </a>  
            <a href="../products">
                Quản lý sản phẩm
            </a> 
            <a href="../employee">
                Quản lý nhân viên
            </a>  
            <a href="../customers">
                Quản lý khách hàng
            </a>  
            <a href="../orders">
                Quản lý hoá đơn
            </a> 
            <a href="../signout.php">
                Đăng xuất
            </a> 
        </div>
    <?php } else {?> 
        <div class="navbar">
            <a href="../index.php">
                Trang chủ
            </a> 
            <a href="../products">
                Quản lý sản phẩm
            </a> 
            <a href="../orders">
                Quản lý hoá đơn
            </a> 
            <a href="../employee/change_infor.php">
                Thay đổi thông tin
            </a> 
            <a href="../signout.php">
                Đăng xuất
            </a> 
        </div>
    <?php }?>
</ul>

<?php if (isset($_SESSION['success'])) {?>
    <div style="color:green">
        <?php echo $_SESSION['success'] ?>
        <?php unset($_SESSION['success']);?>
    </div>
<?php }?>

<?php if (isset($_SESSION['error'])) {?>
    <div style="color:red">
        <?php echo $_SESSION['error']?>
        <?php unset($_SESSION['error']);?>
    </div>
<?php }?>