<?php
    class CUpload{
        public function chktype($type)  {
            return $type ='jpeg'|| $type = 'png' || $type = 'jpg' || $type = 'images/gif';
        }
        public function chksize($size) : bool {
            return $size < 2*1024*1024;
        }

        private function vn_to_slug($str) {
            // Bước 1: Chuyển hết về chữ thường
            $str = mb_strtolower($str, 'UTF-8');
        
            // Bước 2: Chuyển các ký tự có dấu thành không dấu
            $unicode = [
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd'=>'đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i'=>'í|ì|ỉ|ĩ|ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ'
            ];
        
            foreach($unicode as $khongdau => $codau){
                $str = preg_replace("/($codau)/i", $khongdau, $str);
            }
        
            // Bước 3: Xóa các ký tự không mong muốn
            $str = preg_replace('/[^a-z0-9\s\-]/', '', $str);
        
            // Bước 4: Thay khoảng trắng bằng dấu gạch ngang
            $str = preg_replace('/[\s\-]+/', '-', $str);
        
            // Bước 5: Xóa dấu gạch ngang ở đầu hoặc cuối chuỗi
            $str = trim($str, '-');
        
            return $str;
        }
        public function rename($name, $productname){
            $n = pathinfo($name);
            $newname = $this->vn_to_slug($productname)."-".rand(0,10).$n['dirname'].$n['extension'];
            return $newname;
        }

        public function upload($file,$name,$oldfile){
            if($this->chksize($file['size'])){
                if($this->chktype($file['type'])){
                    if (file_exists($oldfile)) {
                        unlink("pic/".$oldfile); // Xóa file cũ nếu tồn tại
                    }
                    $newname = $this->rename($file['name'],$name);
                    $url = "pic/".$newname;
                    if(move_uploaded_file($file['tmp_name'],$url)){
                        return $newname;   
                    }else{
                        echo 'loi';
                    }
                }else{
                    echo 'khong phai anh';
                }
            }else{
                echo 'kich thuoc qua 2MB';
            }
        }
    }
?>