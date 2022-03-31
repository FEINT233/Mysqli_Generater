<?php
class Asd{
    private $aa;
    public function getAa(){
        return $this->aa;
    }

    public function setAa($aa){
        $this->aa= $aa;
    }

    public function toArray(){
        return array("aa"=>$this->aa);
    }

    public function toString(){
        return "{Asd: "."{"."aa:".$this->aa."}"."}";
    }
}
?>
