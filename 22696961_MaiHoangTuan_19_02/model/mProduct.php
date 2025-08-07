<?php
    include("model/mKetNoi.php");
    class modelProduct{
        private function execQuery($query){
            $p = new KetNoi();
            $conn = $p -> mKetNoi();
            if($conn){
                $result = mysqli_query($conn, $query);
                $p->mDongKetNoi($conn);
                return $result;
            }else{
                return false;
            }
        }
        public function selectAllType(){
            $query = "select * from loaisp;";
            $tbl= $this ->execQuery($query);
            return $tbl;
        }
        public function selectAllProducts(){
            $query = "select * from sanpham";
            $tbl= $this ->execQuery($query);
            return $tbl;
        }
        public function selectAllProductsByType($type){
            $query = "select * from sanpham s join loaisp l on s.idLoai = l.idLoai where tenLoai ='$type';";
            $tbl= $this ->execQuery($query);
            return $tbl;
        }
        public function searchProduct($key){
            $query = "select * from sanpham where TenSP like '%$key%'";
            $tbl= $this ->execQuery($query);
            return $tbl;
        }   

        public function selectAProduct($id){
            $query = "select * from sanpham where id = '$id'";
            $tbl= $this ->execQuery($query);
            return $tbl;
        }
        public function insertProduct($name, $price,$cost, $img, $typeId){
            if($price == null){
                $query = "insert into sanpham values ('','$name','','$cost','$img','$typeId')";
            }else{
                $query = "insert into sanpham values ('','$name','$price','$cost','$img','$typeId')";
            }
            $tbl= $this ->execQuery($query);
            return $tbl;
        }

        public function delelteProduct($id)  {
            $query = "delete from sanpham where id = '$id'";
            $tbl= $this ->execQuery($query);
            return $tbl;   
        }

        public function updateProduct($id, $name, $price,$cost,$img, $typeId){
            if($price == null){
                $query = "update sanpham set TenSP = '$name',Gia = null, GiaGoc = $cost, AnhSP='$img', idLoai = '$typeId' where id = '$id'";
            }else{
                $query = "update sanpham set TenSP = '$name', Gia = '$price', GiaGoc = $cost, AnhSP='$img', idLoai = '$typeId' where id = '$id'";
            }
            $tbl= $this ->execQuery($query);
            return $tbl;
        }

        public function isProductNameExist($name){
            $query = "select * from sanpham where TenSP = '$name'";
            $tbl= $this ->execQuery($query);
            if($tbl->num_rows>0){
                return true;
            }else{
                return false;
            }
        }

    }
?>