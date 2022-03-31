<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/FilmActor.class.php";
class FilmActorExample extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($filmActor){
       $this->clause($filmActor, "=", "AND");
    }

    public function Or($filmActor){
       $this->clause($filmActor, "=", "OR");
    }

    public function AndLike($filmActor){
       $this->clause($filmActor, "LIKE", "AND");
    }

    public function OrLike($filmActor){
       $this->clause($filmActor, "LIKE", "OR");
    }

    private function clause($filmActor, $operate, $Lword){
        if($filmActor instanceof FilmActor){
            $values = "";
            if($filmActor->getActorId() != null){
                $values .= "actor_id $operate '".$filmActor->getActorId()."' $Lword ";
            }
            if($filmActor->getFilmId() != null){
                $values .= "film_id $operate '".$filmActor->getFilmId()."' $Lword ";
            }
            if($filmActor->getLastUpdate() != null){
                $values .= "last_update $operate '".$filmActor->getLastUpdate()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
