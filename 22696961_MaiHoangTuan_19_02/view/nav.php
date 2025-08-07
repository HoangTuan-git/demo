<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="menu">
    <a href="index.php">Trang chủ</a>
    <?php
    ob_start();
    if(isset($_SESSION['DN']) && $_SESSION['DN']!=3){
        echo '<a href="admin.php">Quản lý</a>';
    }
    if (isset($_SESSION["DN"])) {
        echo '<a href="index.php?page=logout">Đăng xuất</a>' ;
    }else {
        echo '<a href="index.php?page=dangky">Đăng ký</a>';
        echo '<a href="index.php?page=dangnhap">Đăng nhập</a>';
    }
    ?>

    <form action="" method="get" class="search-form">
        <input type="search" name="txtkey" id="" placeholder="Nhập từ khóa"><button name="btnsm" type="submit">Tìm kiếm</button>
    </form>

    <?php
        if(isset($_REQUEST['btnsm']) && $_REQUEST['txtkey'] != ""){
            $key = $_REQUEST['txtkey'];
            if(isset($_SESSION['DN']) && $_SESSION['DN']!=3){
                header("refresh:0.5;url=admin.php?act=xemsp&txtkey=".$key);
            }else{
                header("location:index.php?txtkey=$key");
            }

        }
    ?>
</div>