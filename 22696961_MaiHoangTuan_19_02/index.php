<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>   
    <div class="container">x`
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
                <h2>List of products</h2>
                <?php
                    include("view/listTOP.php");
                ?>
            </aside>
            <section>  
                <?php 
                    $page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : '';
                    switch ($page) {
                        case "dangky":
                            include("view/dangky.php");
                            break;
                        case "dangnhap":
                            include("view/dangnhap.php");
                            break;
                        case "logout":
                            if(isset($_SESSION['DN'])){
                                include("view/logout.php");
                            }else{
                                echo '<script>alert("Bạn chưa đăng nhập!!")</script>';
                                header("refresh:0.5; url=index.php");
                            }
                            break;
                        default:
                            include_once("view/listProduct.php");                                 
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