<?php
class Elective{
    private $elective_id;
    private $stu_id;
    private $course_id;
    public function getElective_id(){
        return $this->elective_id;
    }

    public function setElective_id($elective_id){
        $this->elective_id= $elective_id;
    }

    public function getStu_id(){
        return $this->stu_id;
    }

    public function setStu_id($stu_id){
        $this->stu_id= $stu_id;
    }

    public function getCourse_id(){
        return $this->course_id;
    }

    public function setCourse_id($course_id){
        $this->course_id= $course_id;
    }

    public function toArray(){
        return array("elective_id"=>$this->elective_id, "stu_id"=>$this->stu_id, "course_id"=>$this->course_id);
    }

    public function toString(){
        return "{Elective: "."{"."elective_id:".$this->elective_id.", "."stu_id:".$this->stu_id.", "."course_id:".$this->course_id."}"."}";
    }
}
?>
