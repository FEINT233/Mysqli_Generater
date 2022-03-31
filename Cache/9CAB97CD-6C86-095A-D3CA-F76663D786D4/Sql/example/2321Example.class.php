<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/2321.class.php";
class 2321Example extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($2321){
       $this->clause($2321, "=", "AND");
    }

    public function Or($2321){
       $this->clause($2321, "=", "OR");
    }

    public function AndLike($2321){
       $this->clause($2321, "LIKE", "AND");
    }

    public function OrLike($2321){
       $this->clause($2321, "LIKE", "OR");
    }

    private function clause($2321, $operate, $Lword){
        if($2321 instanceof 2321){
            $values = "";
            if($2321->get123() != null){
                $values .= "123 $operate '".$2321->get123()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
