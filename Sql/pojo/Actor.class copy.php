<?php
class Actor implements JsonSerializable{
    private $fieldName1;
    private $fieldName2;
    public function getFieldName1(){
        return $this->fieldName1;
    }

    public function setFieldName1($fieldName1){
        $this->fieldName1= $fieldName1;
    }

    public function getFieldName2(){
        return $this->fieldName2;
    }

    public function setfieldName2($fieldName2){
        $this->fieldName2= $fieldName2;
    }

    public function jsonSerialize(){
        $data = [];
        foreach ($this as $key=>$val){
            if ($val !== null) $data[$key] = $val;
        }
        return $data;
    }

    public function toString(){
        $string = "{Actor: "."{";
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
