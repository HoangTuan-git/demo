<?php
session_destroy();
if(!isset($_REQUEST["page"])){
    header("refresh:0.5;url=../index.php?page=logout");
}else{

    echo "<script>alert('Bạn đã đăng xuất thành công!');</script>";
    header("refresh:0.5;url=index.php");
}
exit();
?>