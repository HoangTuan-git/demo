
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <style>
        
    </style>    
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Thêm sản phẩm</h2>
        <table style="width: 100%;" class="form-table">
            <tr>
                <td id="label"><label for="name">Tên sản phẩm:</label></td>
                <td><input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm"></td>
                <td rowspan="6" id="form-img" style="text-align: center;"> <img src="pic/none.jpg" alt="choose image" width ='300' id="img-preview"></td>
            </tr>
            <tr>
                <td id="label"><label for="price">Giá:</label></td>
                <td><input type="text" name="price" id="price" placeholder="Nhập giá sản phẩm"></td>
            </tr>
            <tr>
                <td id="label"><label for="cost">Giá Gốc:</label></td>
                <td><input type="text" name="cost" id="cost" placeholder="Nhập giá gốc sản phẩm"></td>
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
                        include_once("controller/cProduct.php");
                        $p = new CProduct();
                        $result = $p->cGetAllType();
                        echo '<option value="" selected>--Chọn thương hiệu--</option>';
                        while($row = $result->fetch_assoc()){
                            echo '<option value="'.$row['idLoai'].'">'.$row['tenLoai'].'</option>';
                        }
                    ?>
                </select></td>
            </tr> 
            <tr> 
                <td colspan=2 style='text-align: center;'><input type='submit' class="btn" name='btnAdd' value='Thêm sản phẩm' >
                <input type='reset' class="btn" name='btnReset' value='Nhập lại' onclick="clearFile(this)"></td>
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
            const preview = document.getElementById("img-preview");
            // reset ảnh hiển thị về ảnh mặc định
            preview.src = "pic/none.jpg"; // đường dẫn ảnh mặc định

            preview.style.display = "block"; // hiển thị ảnh mặc định
        }
    </script>
    <?php
        if(isset($_POST['btnAdd'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $cost = $_POST['cost'];
            $brand = $_POST['brand'];
            $image = $_FILES['image']['name'];
            
            if(empty($name) || empty($cost) || empty($brand) || empty($image)){
                echo "<script>alert('Vui lòng điền đầy đủ thông tin!')</script>";
            }else{
                if($_FILES['image']['tmp_name'] != ""){
                    include_once("controller/cUpload.php");
                    $u = new CUpload();
                    $newimg=$u->upload($_FILES['image'],$name,"");
                }
                $result = $p->cInsertProduct($name, $price,$cost, $newimg,$brand);
                if($result=="-1"){
                    echo "<script>alert('Thêm sản phẩm thất bại!')</script>";
                }elseif($result == "-2"){
                    echo "<script>alert('Sản phẩm đã tồn tại!')</script>";
                    
                }else{

                    echo "<script>alert('Thêm sản phẩm thành công!')</script>";
                    header("refresh:0.5;url=admin.php?act=xemsp");
                }
            }
        }
    ?>
</body>
</html>