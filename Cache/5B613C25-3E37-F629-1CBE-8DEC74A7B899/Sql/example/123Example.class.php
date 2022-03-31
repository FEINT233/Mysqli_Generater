<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/123.class.php";
class 123Example extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($123){
       $this->clause($123, "=", "AND");
    }

    public function Or($123){
       $this->clause($123, "=", "OR");
    }

    public function AndLike($123){
       $this->clause($123, "LIKE", "AND");
    }

    public function OrLike($123){
       $this->clause($123, "LIKE", "OR");
    }

    private function clause($123, $operate, $Lword){
        if($123 instanceof 123){
            $values = "";
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
