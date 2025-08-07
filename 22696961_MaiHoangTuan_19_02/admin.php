<?php
session_start();
if(!isset($_SESSION['DN']) || $_SESSION['DN']==3){
    echo '<script>alert("bạn không có quyền truy cập trang này!!!")</script>';
    header("refresh:0.5;url=index.php");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>   
    <div class="container">
        <header>
            <img src="pic/header.png" style="width: 100%; max-height: 500px;">
        </header>
        
        <nav>
        <?php  
            include("view/nav.php");
            
        ?>
        </nav>
        <div class="content">
            <aside>
                <ul class="side-menu">
                    <li>Quản lý Thương hiệu
                        <ul class="sub-menu">
                            <a href="admin.php?act=xemloai">Xem DS Thương hiệu</a>
                            <a href="admin.php?act=themloai">Thêm Thương hiệu</a>
                        </ul>
                    </li>
                    <li>Quản lý Sản phẩm
                        <ul class="sub-menu">
                            <a href="admin.php?act=xemsp">Xem DS Sản phẩm</a>
                            <a href="admin.php?act=themsp">Thêm Sản phẩm</a>
                        </ul>
                    </li>
                    <?php
                    if($_SESSION["DN"]==1){
                        echo "<li>Quản lý tài khoản";
                        echo "<ul class='sub-menu'>";
                        echo "<a href='admin.php?act=xemtk'>Xem DS Tài Khoản</a>";
                        echo "<a href='admin.php?act=themtk'>Thêm Tài Khoản</a>";
                        echo "</ul>";
                        echo "</li>";
                    }
                    ?>  
                </ul>
            </aside>

            <section>  
                <?php
                $act=isset($_REQUEST["act"]) ? $_REQUEST["act"] : " ";
                switch ($act) {
                    case "xemsp":
                        include_once("view/qlsanpham.php");
                        break;
                    case "xemtk":
                        include_once("view/qltaikhoan.php");
                        break;
                    case "xemloai":
                        include_once("view/qlthuonghieu.php");
                        break;
                    case "themsp":
                        include_once("view/themsanpham.php");
                        break;
                    case "update":
                        include_once("view/suasanpham.php");
                        break;
                    case "delete":
                        include_once("view/xoasanpham.php");
                        break;
                    default:
                        echo"<h2>Trang admin</h2>";
                }
            ?>
            </section>
        </div>
        <footer>

            22696961-Mai Hoàng Tuấn
        </footer>
    </div>
</body>
</html>