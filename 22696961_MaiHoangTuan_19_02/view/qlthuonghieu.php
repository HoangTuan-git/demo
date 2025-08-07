<?php
    include_once("controller/cProduct.php");
    $p=new CProduct();
    $kq=$p->cGetAllType();
    echo "<h2>Danh sách thương hiệu</h2>";
    if(!$kq){
        echo"Không có thương hiệu!";  
    }else{
        echo"<table class='admin-table'>";
        echo"<tr>";
        echo "<th>STT</th>";
        echo "<th>Tên thương hiệu</th>";
        echo "<th>Hành động</th>";
        echo "</tr>";
        $dem=0;
        while($r=$kq->fetch_assoc()){
            $dem++;
            echo"<tr>";
            echo "<td>".$dem."</td>";
            echo "<td>".$r['tenLoai']."</td>";
            echo "<td><a href='admin.php?act=update&id=".$r['idLoai']."'>Sửa</a> | <a href='admin.php?act=update&id=".$r['idLoai']."'>Xóa</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>