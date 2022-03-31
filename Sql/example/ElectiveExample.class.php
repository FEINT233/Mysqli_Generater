<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/Elective.class.php";
class ElectiveExample extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($elective){
        if($elective instanceof Elective){
            $values = "";
            if($elective->getElective_id() != null){
                $values .= "elective_id = "."'".$elective->getElective_id()."'"." AND ";
            }
            if($elective->getStu_id() != null){
                $values .= "stu_id = "."'".$elective->getStu_id()."'"." AND ";
            }
            if($elective->getCourse_id() != null){
                $values .= "course_id = "."'".$elective->getCourse_id()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function Or($elective){
        if($elective instanceof Elective){
            $values = "";
            if($elective->getElective_id() != null){
                $values .= "elective_id = "."'".$elective->getElective_id()."'"." OR ";
            }
            if($elective->getStu_id() != null){
                $values .= "stu_id = "."'".$elective->getStu_id()."'"." OR ";
            }
            if($elective->getCourse_id() != null){
                $values .= "course_id = "."'".$elective->getCourse_id()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function AndLike($elective){
        if($elective instanceof Elective){
            $values = "";
            if($elective->getElective_id() != null){
                $values .= "elective_id LIKE "."'".$elective->getElective_id()."'"." AND ";
            }
            if($elective->getStu_id() != null){
                $values .= "stu_id LIKE "."'".$elective->getStu_id()."'"." AND ";
            }
            if($elective->getCourse_id() != null){
                $values .= "course_id LIKE "."'".$elective->getCourse_id()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function OrLike($elective){
        if($elective instanceof Elective){
            $values = "";
            if($elective->getElective_id() != null){
                $values .= "elective_id LIKE "."'".$elective->getElective_id()."'"." OR ";
            }
            if($elective->getStu_id() != null){
                $values .= "stu_id LIKE "."'".$elective->getStu_id()."'"." OR ";
            }
            if($elective->getCourse_id() != null){
                $values .= "course_id LIKE "."'".$elective->getCourse_id()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
