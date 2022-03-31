<?php
class 13 implements JsonSerializable{
    private $123;
    public function get123(){
        return $this->123;
    }

    public function set123($123){
        $this->123= $123;
    }

    public function jsonSerialize(){
        $data = [];
        foreach ($this as $key=>$val){
            if ($val !== null) $data[$key] = $val;
        }
        return $data;
    }

    public function toString(){
        $string = "{13: "."{";
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
