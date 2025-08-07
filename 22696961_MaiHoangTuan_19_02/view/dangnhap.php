
<?php
if(!isset($_REQUEST['page'])){
    header("refresh:0.5;url=../index.php?page=dangnhap");
}
if (isset($_REQUEST['sbtn'])) {
    include_once("controller/cNguoiDung.php");
    $p = new controlNguoiDung();
    $p -> Login($_REQUEST["txtEmail"],$_REQUEST["txtPass"]);
}
?>
<form method="post" action="" class="form">
    <h2>Đăng nhập</h2>
    <div class="form-group"> 
        <input type="text" name="txtEmail" id="txtuser" required>
    </div>

    <div class="form-group">
        <input type="password" name="txtPass" id="txtpass" required>
    </div>
    <input type="submit" class="btn" value="Đăng nhập" name="sbtn">
</form>