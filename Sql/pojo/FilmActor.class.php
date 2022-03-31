<?php
class FilmActor implements JsonSerializable{
    private $actorId;
    private $filmId;
    private $lastUpdate;
    public function getActorId(){
        return $this->actorId;
    }

    public function setActorId($actorId){
        $this->actorId= $actorId;
    }

    public function getFilmId(){
        return $this->filmId;
    }

    public function setFilmId($filmId){
        $this->filmId= $filmId;
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
        $string = "{FilmActor: "."{";
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
