<?php
    include("model/mProduct.php");
    class CProduct{
        private function getResult($functionName, $val){
            $m = new modelProduct();
            if($val==""){
                $tbl = $m->$functionName();
            }else{
                $tbl = $m->$functionName($val);
            }
            if(!$tbl){
                return "-2";
            }else{
                if($tbl->num_rows>0){
                    return $tbl;
                }else{ 
                    return "-1";
                }
            }
        }
        public function cGetAllType()  {
            return $this->getResult("selectAllType","");
        }
        public function cGetAllProduct()  {
            return $this->getResult("selectAllProducts","");
        }
        public function cGetAllProductByType($type)  {
            return $this->getResult("selectAllProductsByType","$type");
        }
        public function cGetAllProductByKey($key)  {
            return $this->getResult("searchProduct","$key");
        }

        public function cGetAProduct($id)  {
            return $this->getResult("selectAProduct","$id");
        }
        public function cInsertProduct($name, $price, $cost, $img, $typeId)  {
            $m = new modelProduct();
            if($m->isProductNameExist($name)){
                return "-2";
            }else{
                $tbl = $m->insertProduct($name, $price, $cost, $img, $typeId);
                return $tbl? true : "-1";
            }
        }   
        public function cDeleteProduct($id)  {
            return $this->getResult("delelteProduct","$id");
        }
        public function cUpdateProduct($id, $name, $price,$cost, $img, $typeId)  {
            $m = new modelProduct();
            $tbl = $m->updateProduct($id, $name, $price,$cost, $img, $typeId);
            if($tbl){
                return true;
            }else{
                return false;
            }
        }

    }
?>
