<?php
$page = isset($_REQUEST["page"]) ? $_REQUEST["page"] : '';
switch ($page) {
    case "dangky":
        include("view/dangky.php");
        break;
    case "dangnhap":
        include("view/dangnhap.php");
        break;
    case "xlydn":
        include("view/xulydn.php");
        break;
    case "logout":
        include("view/logout.php");
        break;
    default:
        echo "<h2>Trang Chủ</h2>";

}
?>