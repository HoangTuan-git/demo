<?php
    class KetNoi{
        public function mKetNoi(){
            $host = 'localhost';
            $user_name= 'maituan04';
            $pass = 'maituan04';
            $db= 'quanlibanhang';
            // $host = 'sql107.infinityfree.com';
            // $user_name= 'if0_38047893';
            // $pass = '8XZduhtXZMyEqng';
            // $db= 'if0_38047893_tuan';
            $conn = mysqli_connect($host, $user_name, $pass, $db);
            mysqli_set_charset($conn, "utf8");
            if($conn->connect_error){
                return false;
            }else{
                return $conn;
            }
        }
        public function mDongKetNoi($conn){
            $conn ->close();
        }
    }
?>