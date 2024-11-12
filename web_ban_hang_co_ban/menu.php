<?php //session_start();
?>
<style>
    <?php require_once 'fixed_menu.css';?>
</style>
<?php if (isset($_SESSION['id'])) {?>
    <div class="navbar">      
        <a href="index.php">Trang chủ</a> 
        <a href="cart.php">Xem giỏ hàng</a>
        <a href="order.php">Xem hoá đơn</a>
        <a href="user.php">Trang cá nhân</a>
        <a href="change_password.php">Đổi mật khẩu</a>
        <a href="change_infor.php">Đổi thông tin liên hệ</a>
        <a href="signout.php">Đăng xuất</a>  
    </div>
<?php } else {?>
    <div class="navbar">
        <a href="index.php">Trang chủ</a>
        <a href="signin_form.php">Đăng nhập</a>  
        <a href="signup_form.php">Đăng ký</a>  
    </div>
    
<?php }?>
<?php if (isset($_SESSION['success'])) {?>
    <div style="color:green">
        <?php echo $_SESSION['success']?>
        <?php unset($_SESSION['success'])?>
    </div>
<?php }?>

<?php if (isset($_SESSION['error'])) {?>
    <div style="color:red">
        <?php echo $_SESSION['error']?>
        <?php unset($_SESSION['error'])?>
    </div>
<?php }?>