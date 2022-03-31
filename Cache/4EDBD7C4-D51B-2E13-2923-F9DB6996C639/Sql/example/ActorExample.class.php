<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/Actor.class.php";
class ActorExample extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($actor){
       $this->clause($actor, "=", "AND");
    }

    public function Or($actor){
       $this->clause($actor, "=", "OR");
    }

    public function AndLike($actor){
       $this->clause($actor, "LIKE", "AND");
    }

    public function OrLike($actor){
       $this->clause($actor, "LIKE", "OR");
    }

    private function clause($actor, $operate, $Lword){
        if($actor instanceof Actor){
            $values = "";
            if($actor->getActorId() != null){
                $values .= "actor_id $operate '".$actor->getActorId()."' $Lword ";
            }
            if($actor->getFirstName() != null){
                $values .= "first_name $operate '".$actor->getFirstName()."' $Lword ";
            }
            if($actor->getLastUpdate() != null){
                $values .= "last_update $operate '".$actor->getLastUpdate()."' $Lword ";
            }
            if($actor->getLastName() != null){
                $values .= "last_name $operate '".$actor->getLastName()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
