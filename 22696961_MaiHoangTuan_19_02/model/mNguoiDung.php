<?php
    include_once('model/mKetNoi.php');
    class modelNguoiDung{
        private function execQuery($query){
            $p = new KetNoi();
            $conn = $p->mKetNoi();
            if($conn){    
                $result= $conn ->query($query);
                $p->mDongKetNoi($conn) ;
                return $result;
            }else{
                $p->mDongKetNoi($conn) ;
                return false;
            }
        }
        public function isUserExist($user){
            $chkUser = "select * from taikhoan where TenTK='$user'";
            $result = $this->execQuery($chkUser);
            return $result->num_rows > 0;
        }
    
        public function mRegis($user, $pass){
            $strRegis = "insert into taikhoan values('','$user','$pass','3','')";
            $result = $this->execQuery($strRegis);
            return $result;
        }
        public function mLogin($user, $pass){
            $strLogin = "select * from taikhoan where TenTK='$user' and MatKhau ='$pass'";
            $result =  $this->execQuery($strLogin);
            return $result;
        }

        public function mGetAllUser(){
            $strRegis = "select * from taikhoan join vaitro on taikhoan.LoaiTaiKhoan = vaitro.MaVT";
            $result =  $this->execQuery($strRegis);
            return $result;
        }
    }
?>