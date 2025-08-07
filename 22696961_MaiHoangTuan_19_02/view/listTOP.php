<?php 
    ob_start();
    include("controller/cProduct.php");
    if(isset($_SESSION["admin"])){
        echo '<a href="#">Quản Lý Thương Hiệu</a>';
        echo '<a href="#">Quản Lý Sản Phẩm</a>';
    }else{
        $p = new CProduct();
        $tbl = $p ->cgetAllType();
        while($r=$tbl -> fetch_assoc()){
            $loai =$r['tenLoai'];
            echo "<a href='index.php?type=$loai'>$loai</a>";     
        }
    }
?>