<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Chỉnh sửa sản phẩm</h2>
        <?php
            if(!isset($_REQUEST["act"])){
                header("refresh:0.5;url=../admin.php");
            }
            include("controller/cProduct.php");
            $p = new CProduct();
            $id = $_REQUEST['id'];
            $result = $p->cGetAProduct($id);
            if($result == "-1"){
                echo "<script>alert('Không tìm thấy sản phẩm')</script>";
                header("refresh:0.5;url=admin.php?act=xemsp");
            }else if($result == "-2"){    
                echo "<script>alert('Lỗi kết nối')</script>";
                header("refresh:0.5;url=admin.php?act=xemsp");
            }else{
                $r = $result->fetch_assoc();    
            }
        ?>
        <table class="form-table" style="width: 100%;">
            <tr>
                <td id="label"><label for="name">Tên sản phẩm:</label></td>
                <td><input type="text" name="name" id="name" value="<?php echo $r['TenSP']; ?>"></td>
                <td rowspan="6" id="form-img" style="text-align: center;"> <?php echo "<img src='pic/".$r['AnhSP']."' id='img-preview' alt='' width ='300'>"?></td>
                
            </tr>
            <tr>
                <td id="label"><label for="price">Giá:</label></td>
                <td><input type="text" name="price" id="price" value="<?php echo $r['Gia']; ?>"></td>
            </tr>
            <tr>
                <td id="label"><label for="cost">Giá Gốc:</label></td>
                <td><input type="text" name="cost" id="cost" value="<?php echo $r['GiaGoc']; ?>"></td>
            </tr>
            <tr>
                <td id="label"><label for="image">Hình ảnh:</label></td>
                <td><input type="file" name="image" id="image" hidden onchange="showFile(this)">
                    <label for="image" class="btnfile" id="file-name">Chọn ảnh sản phẩm</label></td>
            </tr>
            <tr>
                <td id="label"><label for="brand">Thương hiệu:</label></td>
                <td><select name="brand" id="brand">
                    <?php
                        $result = $p->cGetAllType();
                        while($row = $result->fetch_assoc()){
                            if($row['idLoai'] == $r['idLoai']){
                                echo '<option value="'.$row['idLoai'].'" selected>'.$row['tenLoai'].'</option>';
                            }else{
                                echo '<option value="'.$row['idLoai'].'">'.$row['tenLoai'].'</option>';
                            }
                        }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn" value="Cập nhật" name="btnUpdate">
                    <input type="reset" class="btn" value="Nhập lại" onclick="clearFile(this)">
                </td>
            </tr>
        </table>
    </form>
    <script>
        function showFile(input) {
            const fileName = input.files[0] ? input.files[0].name : "Chọn ảnh sản phẩm";
            document.getElementById("file-name").textContent = fileName;
            const file = event.target.files[0];
            if (file) {
                const preview = document.getElementById("img-preview");
                preview.src = URL.createObjectURL(file); // tạo đường dẫn tạm
                preview.style.display = "block";
            }
        }
        function clearFile(input) {
            document.getElementById("file-name").textContent = "Chọn ảnh sản phẩm";
             // reset ảnh hiển thị
            const defaultImage = "pic/<?php echo $r['AnhSP']; ?>";
            const preview = document.getElementById("img-preview");
            // reset ảnh hiển thị về ảnh mặc định
            // đường dẫn ảnh mặc định
            preview.src = defaultImage; // đường dẫn ảnh mặc định
            preview.style.display = "block"; // hiển thị ảnh mặc định
        }
    </script>
    <?php
        if(isset($_REQUEST['btnUpdate'])){
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $price = $_REQUEST['price'];
            $cost = $_REQUEST['cost'];
            $brand = $_REQUEST['brand'];
            $oldimage = $r['AnhSP'];
            if($_FILES['image']['name'] != ""){
                include_once("controller/cUpload.php");
                $u = new CUpload();
               $newimg=$u->upload($_FILES['image'], $name, $oldimage);
               $kq=$p->cUpdateProduct($id, $name, $price,$cost,$newimg, $brand);
            }else{
                $kq=$p->cUpdateProduct($id, $name, $price,$cost,$oldimage, $brand);
            }
            if($kq){
                echo '<script>alert("Cập nhật sản phẩm thành công!")</script>';
                header("refresh:0.5; url=admin.php?act=xemsp");
            }else{
                echo "<script>alert('Không tìm thấy sản phẩm')</script>";
                header("refresh:0.5;url=admin.php?act=xemsp");
            }
            
        }
    ?>
</body>
</html>