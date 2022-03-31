<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/1234.class.php";
class 1234Example extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($1234){
       $this->clause($1234, "=", "AND");
    }

    public function Or($1234){
       $this->clause($1234, "=", "OR");
    }

    public function AndLike($1234){
       $this->clause($1234, "LIKE", "AND");
    }

    public function OrLike($1234){
       $this->clause($1234, "LIKE", "OR");
    }

    private function clause($1234, $operate, $Lword){
        if($1234 instanceof 1234){
            $values = "";
            if($1234->get123() != null){
                $values .= "123 $operate '".$1234->get123()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = " ORDER BY ".$kind;
    }
}
?>
