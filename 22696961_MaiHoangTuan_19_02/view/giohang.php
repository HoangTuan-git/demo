<h2>Giỏ Hàng</h2>
<table style="width: 100%;" class="form-table">
    <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng tiền</th>
        <th>Xóa</th>
    </tr>
    <?php
    $i = 1;
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['price'] * $value['quantity'];
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $value['name'] . "</td>";
        echo "<td><img src='" . $value['image'] . "' alt='" . $value['name'] . "' width='100'></td>";
        echo "<td>" . number_format($value['price'], 0, ',', '.') . " VNĐ</td>";
        echo "<td><input type='number' name='quantity[" . $key . "]' value='" . $value['quantity'] . "' min='1'></td>";
        echo "<td>" . number_format($value['price'] * $value['quantity'], 0, ',', '.') . " VNĐ</td>";
        echo "<td><a href='index.php?controller=cart&action=delete&id=" . $key . "'>Xóa</a></td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <td colspan="5" style="text-align: right;">Tổng tiền:</td>
        <td colspan="2"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</td>
    </tr>
</table>
<a href="index.php?controller=cart&action=checkout" class="btn">Thanh toán</a>
<a href="index.php?controller=home" class="btn">Tiếp tục mua sắm</a>