<?php
class Student implements JsonSerializable{
    private $stuId;
    public function getStuId(){
        return $this->stuId;
    }

    public function setStuId($stuId){
        $this->stuId= $stuId;
    }

    public function jsonSerialize(){
        $data = [];
        foreach ($this as $key=>$val){
            if ($val !== null) $data[$key] = $val;
        }
        return $data;
    }

    public function toString(){
        $string = "{Student: "."{";
        foreach ($this as $key=>$val){
            if ($val !== null){
                if(gettype($val) === "string") $string .= $key." : '".$val."', ";
                else if(gettype($val) === "integer") $string .= $key." : ".$val.", ";
            }
            else $string .= $key." : null, ";
        }
        $string = rtrim($string,', ');
        return $string."}"."}";
    }
}
?>
