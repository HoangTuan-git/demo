<?php
    include_once("controller/cProduct.php");
    $p = new CProduct();
 
    if(isset($_REQUEST['type'])){
        $type = $_REQUEST['type'];
        echo '<h2>Sản phẩm '.$type.'</h2>';
        $tb = $p -> cGetAllProductByType($type);
    }elseif(isset($_REQUEST['txtkey']) && $_REQUEST['txtkey'] != ""){
        $key = $_REQUEST['txtkey'];
        echo '<h2>Tìm kiếm sản phẩm "'.$key.'"</h2>';
        $tb = $p -> cGetAllProductByKey($key);
    }else{
        echo "<h2>Trang Chủ</h2>"; 
        $tb = $p -> cGetAllProduct();
    }
    if($tb=="-1"){
        echo"Không có sản phẩm!";
    }else{
        echo "<table class='product-item'><tr>";
        $col = 0;
        while($r = $tb->fetch_assoc()){
            $anh ="pic/".$r['AnhSP'];
            echo"<td>"."<a href='#' id='product-link'>"."<img src='$anh' width='100' height='75' alt='".$r['AnhSP']."'>";
            echo "<br>".$r['TenSP'];
            if($r['Gia'] != null){
                $gia =number_format($r['Gia'],0,".",",")."đ";
                $giagoc =number_format($r['GiaGoc'],0,".",",")."đ";
                echo "<br><b>".$gia."</b><br>";
                echo"<s>".$giagoc."</s></a></td>";
            }else{
                $gia =number_format($r['GiaGoc'],0,".",",")."đ";
                echo "<br><b>".$gia."</b></a></td>";
            }
            $col++;
            if ($col % 4 == 0) {
                echo "</tr><tr>";
            }
        }
        echo "</tr></table>";
    }
?>
