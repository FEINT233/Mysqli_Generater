<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/13.class.php";
class 13Example extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($13){
       $this->clause($13, "=", "AND");
    }

    public function Or($13){
       $this->clause($13, "=", "OR");
    }

    public function AndLike($13){
       $this->clause($13, "LIKE", "AND");
    }

    public function OrLike($13){
       $this->clause($13, "LIKE", "OR");
    }

    private function clause($13, $operate, $Lword){
        if($13 instanceof 13){
            $values = "";
            if($13->get123() != null){
                $values .= "123 $operate '".$13->get123()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
