<?php
class Actor implements JsonSerializable{
    private $actorId;
    private $actorId;
    public function getActorId(){
        return $this->actorId;
    }

    public function setActorId($actorId){
        $this->actorId= $actorId;
    }

    public function getActorId(){
        return $this->actorId;
    }

    public function setActorId($actorId){
        $this->actorId= $actorId;
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
