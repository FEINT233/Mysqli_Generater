<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/Student.class.php";
class StudentExample extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($student){
        if($student instanceof Student){
            $values = "";
            if($student->getStuId() != null){
                $values .= "stu_id = "."'".$student->getStuId()."'"." AND ";
            }
            if($student->getStuName() != null){
                $values .= "stu_name = "."'".$student->getStuName()."'"." AND ";
            }
            if($student->getStuSex() != null){
                $values .= "stu_sex = "."'".$student->getStuSex()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function Or($student){
        if($student instanceof Student){
            $values = "";
            if($student->getStuId() != null){
                $values .= "stu_id = "."'".$student->getStuId()."'"." OR ";
            }
            if($student->getStuName() != null){
                $values .= "stu_name = "."'".$student->getStuName()."'"." OR ";
            }
            if($student->getStuSex() != null){
                $values .= "stu_sex = "."'".$student->getStuSex()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function AndLike($student){
        if($student instanceof Student){
            $values = "";
            if($student->getStuId() != null){
                $values .= "stu_id LIKE "."'".$student->getStuId()."'"." AND ";
            }
            if($student->getStuName() != null){
                $values .= "stu_name LIKE "."'".$student->getStuName()."'"." AND ";
            }
            if($student->getStuSex() != null){
                $values .= "stu_sex LIKE "."'".$student->getStuSex()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function OrLike($student){
        if($student instanceof Student){
            $values = "";
            if($student->getStuId() != null){
                $values .= "stu_id LIKE "."'".$student->getStuId()."'"." OR ";
            }
            if($student->getStuName() != null){
                $values .= "stu_name LIKE "."'".$student->getStuName()."'"." OR ";
            }
            if($student->getStuSex() != null){
                $values .= "stu_sex LIKE "."'".$student->getStuSex()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
