<?php
    include_once('model/mNguoiDung.php');
     controlNguoiDung{
        public function Login($TDN, $MK) : void {
            $p = new modelNguoiDung();
            $MK = md5($MK);
            $tblTaiKhoan = $p ->mLogin($TDN,$MK);            
            if(!$tblTaiKhoan){
                echo "<script>alert('Lỗi kết nối')</script>";
                header("refresh:0.5;url=index.php?page=dangnhap");
            } else{
                if($tblTaiKhoan -> num_rows >0){
                    //dang nhap thanh cong
                    while($row = $tblTaiKhoan -> fetch_assoc()){
                        $_SESSION['DN'] = $row['LoaiTaiKhoan'];
                    }
                    echo" <script>alert('Đăng nhập thành công!!')</script>";
                    if($_SESSION['DN'] == 3){
                        header("refresh:0.5;url=index.php");;;;;;
                    }else{
                        header("refresh:0.5;url=admin.php");
                    }
                }else{
                    //sai thong tin dang nhap
                    echo "<script>alert('Đăng nhập thất bại')</script>";
                    header("refresh:0.5;url=index.php?page=dangnhap");

                }
            } 
        }
        public function Regis($TDN, $MK) : void {
            $p = new modelNguoiDung();
            $MK = md5($MK);
            if(!$p->isUserExist($TDN)){//ten dn chua ton tai
                $tblTaiKhoan = $p ->mRegis($TDN,$MK);
                if(!$tblTaiKhoan){
                    echo "<script>alert('Lỗi kết nối')</script>";
                    header("refresh:0.5;url=index.php?page=dangky");
                } else{
                        echo "<script>alert('Đăng ký thành công!')</script>";
                        header("refresh:0.5;url=index.php?page=dangnhap");
                }
            }else{//trung ten dang nhap
                echo'<script>alert("Tên đăng nhập hoặc email đã tồn tại.")</script>';
                header("refresh:0;url=index.php?page=dangky");
            }
            
        }

        public function getAllUsers(){
            $p = new modelNguoiDung();
            $tblTaiKhoan = $p ->mgetAllUser();
            return $tblTaiKhoan;
        }
    }
?>