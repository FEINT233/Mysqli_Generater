<?php
class Student{
    private $stuId;
    private $stuName;
    private $stuSex;
    public function getStuId(){
        return $this->stuId;
    }

    public function setStuId($stuId){
        $this->stuId= $stuId;
    }

    public function getStuName(){
        return $this->stuName;
    }

    public function setStuName($stuName){
        $this->stuName= $stuName;
    }

    public function getStuSex(){
        return $this->stuSex;
    }

    public function setStuSex($stuSex){
        $this->stuSex= $stuSex;
    }

    public function toArray(){
        return array("stuId"=>$this->stuId, "stuName"=>$this->stuName, "stuSex"=>$this->stuSex);
    }

    public function toString(){
        return "{Student: "."{"."stuId:".$this->stuId.", "."stuName:".$this->stuName.", "."stuSex:".$this->stuSex."}"."}";
    }
}
?>
