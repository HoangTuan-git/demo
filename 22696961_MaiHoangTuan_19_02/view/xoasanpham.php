<?php
    if(!isset($_REQUEST["act"])){
        header("refresh:0.5;url=../admin.php");
    }
    include("controller/cProduct.php");
    if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $p=new CProduct();
        $kq=$p->cDeleteProduct($id);
        if($kq){
            echo "<script>alert('Xóa sản phẩm thành công!');</script>";
        }elseif($kq=="-2"){
            echo "<script>alert('Lỗi kết nối!');</script>";
        }else{
            echo "<script>alert('Không tìm thấy sản phẩm!');</script>";
        }
        header("refresh:0.5;url=admin.php?act=xemsp");
    }

?>