<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/12345.class.php";
class 12345Example extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($12345){
       $this->clause($12345, "=", "AND");
    }

    public function Or($12345){
       $this->clause($12345, "=", "OR");
    }

    public function AndLike($12345){
       $this->clause($12345, "LIKE", "AND");
    }

    public function OrLike($12345){
       $this->clause($12345, "LIKE", "OR");
    }

    private function clause($12345, $operate, $Lword){
        if($12345 instanceof 12345){
            $values = "";
            if($12345->get123() != null){
                $values .= "123 $operate '".$12345->get123()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
