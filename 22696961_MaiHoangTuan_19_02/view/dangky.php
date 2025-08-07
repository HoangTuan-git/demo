<?php
include_once("controller/cNguoiDung.php");
$p = new controlNguoiDung();
if(!isset($_REQUEST['page'])){
    header("refresh:0.5;url=../index.php?page=dangky");
}
if (isset($_REQUEST['sbtn'])) {
    $email = $_POST["txtEmail"];
    $pass = $_POST["txtPass"];

   $p->Regis($email, $pass);
}
?>

<form method="post" class="form">
    <h2>Đăng ký</h2>
    <div class="form-group">
        <input type="text" name="txtEmail" id="txtuser" placeholder="Tên đăng ký" required>
    </div>

    <div class="form-group">
        <input type="password" name="txtPass" id="txtpass" placeholder="Mật Khẩu" required>
    </div>
    <input type="submit" class="btn" value="Đăng ký" name="sbtn">
</form>