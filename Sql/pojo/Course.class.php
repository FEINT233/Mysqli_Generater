<?php
class Course{
    private $course_id;
    private $course_name;
    public function getCourse_id(){
        return $this->course_id;
    }

    public function setCourse_id($course_id){
        $this->course_id= $course_id;
    }

    public function getCourse_name(){
        return $this->course_name;
    }

    public function setCourse_name($course_name){
        $this->course_name= $course_name;
    }

    public function toArray(){
        return array("course_id"=>$this->course_id, "course_name"=>$this->course_name);
    }

    public function toString(){
        return "{Course: "."{"."course_id:".$this->course_id.", "."course_name:".$this->course_name."}"."}";
    }
}
?>
