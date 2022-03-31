<?php
class 123{
    private $132;
    public function get132(){
        return $this->132;
    }

    public function set132($132){
        $this->132= $132;
    }

    public function toArray(){
        return array("132"=>$this->132);
    }

    public function toString(){
        return "{123: "."{"."132:".$this->132."}"."}";
    }
}
?>
