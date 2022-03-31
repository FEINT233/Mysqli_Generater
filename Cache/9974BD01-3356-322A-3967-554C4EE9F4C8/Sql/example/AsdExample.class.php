<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/pojo/Asd.class.php";
class AsdExample{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($asd){
        if($asd instanceof Asd){
            $values = "";
            if($asd->getAa() != null){
                $values .= "aa = "."'".$asd->getAa()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function Or($asd){
        if($asd instanceof Asd){
            $values = "";
            if($asd->getAa() != null){
                $values .= "aa = "."'".$asd->getAa()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function AndLike($asd){
        if($asd instanceof Asd){
            $values = "";
            if($asd->getAa() != null){
                $values .= "aa LIKE "."'".$asd->getAa()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function OrLike($asd){
        if($asd instanceof Asd){
            $values = "";
            if($asd->getAa() != null){
                $values .= "aa LIKE "."'".$asd->getAa()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
