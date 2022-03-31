<?php
class Actor implements JsonSerializable{
    private $actorId;
    private $firstName;
    private $lastName;
    private $lastUpdate;
    public function getActorId(){
        return $this->actorId;
    }

    public function setActorId($actorId){
        $this->actorId= $actorId;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function setFirstName($firstName){
        $this->firstName= $firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName= $lastName;
    }

    public function getLastUpdate(){
        return $this->lastUpdate;
    }

    public function setLastUpdate($lastUpdate){
        $this->lastUpdate= $lastUpdate;
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
