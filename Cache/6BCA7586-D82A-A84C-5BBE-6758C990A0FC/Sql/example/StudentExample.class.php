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
       $this->clause($student, "=", "AND");
    }

    public function Or($student){
       $this->clause($student, "=", "OR");
    }

    public function AndLike($student){
       $this->clause($student, "LIKE", "AND");
    }

    public function OrLike($student){
       $this->clause($student, "LIKE", "OR");
    }

    private function clause($student, $operate, $Lword){
        if($student instanceof Student){
            $values = "";
            if($student->getStuId() != null){
                $values .= "stu_id $operate '".$student->getStuId()."' $Lword ";
            }
        }
        $this->condition = rtrim($values," $Lword ");
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
