<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/pojo/123.class.php";
class 123Example{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($123){
        if($123 instanceof 123){
            $values = "";
            if($123->get132() != null){
                $values .= "132 = "."'".$123->get132()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function Or($123){
        if($123 instanceof 123){
            $values = "";
            if($123->get132() != null){
                $values .= "132 = "."'".$123->get132()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function AndLike($123){
        if($123 instanceof 123){
            $values = "";
            if($123->get132() != null){
                $values .= "132 LIKE "."'".$123->get132()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function OrLike($123){
        if($123 instanceof 123){
            $values = "";
            if($123->get132() != null){
                $values .= "132 LIKE "."'".$123->get132()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
