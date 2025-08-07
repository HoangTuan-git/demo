<?php

    if($_SESSION['DN']!=1){
        if(!isset($_REQUEST["act"])){
            echo '<script>alert("Bạn Không có quyền truy cập trang này!!")</script>';
            header("refresh:0.5;url=../index.php");
        }else
            header("refresh:0.5;url=index.php");
    }
    include_once("controller/cNguoiDung.php");
    $p=new controlNguoiDung();
    $kq=$p->getAllUsers();
    echo "<h2>Danh sách người dùng</h2>";
    if(!$kq){
        echo"Không có người dùng!";
    }else{
        echo"<table class='admin-table'>";
        echo"<tr>";
        echo "<th>STT</th>";
        echo "<th>Tên người dùng</th>";
        echo "<th>Loại tài khoản</th>";
        echo "<th>Hành động</th>";
        echo "</tr>";
        $dem=0;
        while($r=$kq->fetch_assoc()){
            $dem++;
            echo"<tr>";
            echo "<td>".$dem."</td>";
            echo "<td>".$r['TenTK']."</td>";
            echo "<td>". $r['TenVT'] . "</td>";
            echo "<td><a href='admin.php?act=update&id=".$r['MaTK']."'>Sửa</a> | <a href='admin.php?act=delete&id=".$r['MaTK']."'>Xóa</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>