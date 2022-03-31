<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/interface/SqlExample.interface.php";
require_once BASE_PATH."Sql/pojo/Course.class.php";
class CourseExample extends SqlExampleInterface{
    private $condition = ""; //where ()
    private $kind = "";      //Order by; 

    public function getCondition(){
        return $this->condition;
    }

    public function getKind(){
        return $this->kind;
    }

    public function And($course){
        if($course instanceof Course){
            $values = "";
            if($course->getCourse_id() != null){
                $values .= "course_id = "."'".$course->getCourse_id()."'"." AND ";
            }
            if($course->getCourse_name() != null){
                $values .= "course_name = "."'".$course->getCourse_name()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function Or($course){
        if($course instanceof Course){
            $values = "";
            if($course->getCourse_id() != null){
                $values .= "course_id = "."'".$course->getCourse_id()."'"." OR ";
            }
            if($course->getCourse_name() != null){
                $values .= "course_name = "."'".$course->getCourse_name()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function AndLike($course){
        if($course instanceof Course){
            $values = "";
            if($course->getCourse_id() != null){
                $values .= "course_id LIKE "."'".$course->getCourse_id()."'"." AND ";
            }
            if($course->getCourse_name() != null){
                $values .= "course_name LIKE "."'".$course->getCourse_name()."'"." AND ";
            }
        }
        $this->condition = rtrim($values,' AND ');
    }

    public function OrLike($course){
        if($course instanceof Course){
            $values = "";
            if($course->getCourse_id() != null){
                $values .= "course_id LIKE "."'".$course->getCourse_id()."'"." OR ";
            }
            if($course->getCourse_name() != null){
                $values .= "course_name LIKE "."'".$course->getCourse_name()."'"." OR ";
            }
        }
        $this->condition = rtrim($values,' OR ');
    }

    public function OrderBy($kind){
        $this->kind = $kind;
    }
}
?>
