
<?php
    if(!isset($_REQUEST["act"])){
        header("refresh:0.5;url=../admin.php");
    }
    include_once("controller/cProduct.php");
    $p=new CProduct();
    if(isset($_REQUEST['txtkey']) && $_REQUEST['txtkey'] != "" && $_SESSION['DN']!=3){
        $key = $_REQUEST['txtkey'];
        echo '<h2>Tìm kiếm sản phẩm "'.$key.'"</h2>';
        $kq = $p -> cGetAllProductByKey($key);
    }else{
        $kq=$p->cGetAllProduct();
    }
    echo "<h2>Danh sách sản phẩm</h2>";
    if($kq == "-1"){
        echo"Không có sản phẩm!";
    }else{
        echo"<table class='admin-table'>";
        echo"<tr>";
        echo "<th>STT</th>";
        echo "<th>Tên sản phẩm</th>";
        echo "<th>Hình ảnh</th>";
        echo "<th>Giá bán</th>";
        echo "<th>Giá gốc</th>";
        echo "<th>Hành động</th>";
        echo "</tr>";
        $dem=0;
        while($r=$kq->fetch_assoc()){
            $dem++;
            echo"<tr>";
            echo "<td>".$dem."</td>";
            echo "<td>".$r['TenSP']."</td>";
            $img = "pic/".$r['AnhSP'];
            echo "<td><img src='".$img . "' alt='" . $r['TenSP'] . "' width='100px' height='75px'></td>";
            if($r['Gia'] != null){
                
                $gia =number_format($r['Gia'],0,".",",")."đ";
                echo "<td>". $gia ."</td>";
            }else{
                echo "<td></td>";
            }
            $giagoc =number_format($r['GiaGoc'],0,".",",")."đ";
            echo "<td>". $giagoc ."</td>";
            echo "<td>
            <a href='admin.php?act=update&id=" . $r['id'] . "'>Sửa</a> | 
            <a href='admin.php?act=delete&id=" . $r['id'] . "' onclick='return confirm(\"Xác nhận xóa sản phẩm\");'>Xóa</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>