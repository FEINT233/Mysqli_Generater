<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/pojo/Course.class.php";
require_once BASE_PATH."Sql/example/CourseExample.class.php";
class CourseDao extends SqlDaoInterface{
    private $conn;
    private $tableName = "course";
    /**
     * 获取数据库连接,每次进行数据库操作后关闭数据库连接
     */
    private function getConn(){
        $MysqlConnect = new MysqlConnect();
        $this->conn = $MysqlConnect->getMysqlConnect_Mysqli("school");
    }
    /**
     * 全字段查询,返回一个数组
     * 数组里有对象信息的键值对格式信息
     * @return $data不为0时返回存储对应类型po对象的数组,否则返回0 
     */
    public function select(){
        $this->getConn();
        $data = array();
        $sql = "SELECT * FROM $this->tableName";
        $result = mysqli_query($this->conn, $sql);
        while($row=$result->fetch_array()){
            $course = new Course();
            $course->setCourse_id($row["course_id"]);
            $course->setCourse_name($row["course_name"]);
            $data[] = $course->toArray();
        }
        mysqli_close($this->conn);
        return count($data)!=0?$data:0;
    }
    /**
     * 没有主键的表
     */
    public function selectByPK($PK){
    }
    /**
     * 根据选择字段查询
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return $data不为0时返回存储对应类型po对象的数组,否则返回0
     */
    public function selectByExample($POJOExample){
        if($POJOExample instanceof CourseExample){
            $this->getConn();
            $values = "";
            if($POJOExample->getCondition() != ""){
                $values .= " WHERE ".$POJOExample->getCondition();
            }
            if($POJOExample->getKind() != ""){
                $values .= " ".$POJOExample->getKind();
            }
            $data = array();
            $sql = "SELECT * FROM ".$this->tableName.$values;
            $result = mysqli_query($this->conn, $sql);
        while($row=$result->fetch_array()){
            $course = new Course();
            $course->setCourse_id($row["course_id"]);
            $course->setCourse_name($row["course_name"]);
            $data[] = $course->toArray();
        }
            mysqli_close($this->conn);
            return count($data)!=0?$data:0;
        }
        return false;
    }
    /**
     * 全字段插入
     * 插入前还得用instanceof 检测参数是否为对应的实现类
     * @param $POJO 需把对象所有变量都设置
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function insert($POJO){
        if($POJO instanceof Course){
            $this->getConn();
            $values = "";
            $values .= "'".$POJO->getCourse_id()."',";
            $values .= "'".$POJO->getCourse_name()."',";
            $sql = "INSERT INTO ".$this->tableName." VALUES(".rtrim($values, ',').")";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     * 选择字段插入,数据库有的字段不是必填的
     * 可以null
     * @param $POJO 需把对象任意变量设置
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function insertByExample($POJO){
        if($POJO instanceof Course){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->getCourse_id() != null){
                $keys .= "course_id,";
                $values .= "'".$POJO->getCourse_id()."',";
            }
            if($POJO->getCourse_name() != null){
                $keys .= "course_name,";
                $values .= "'".$POJO->getCourse_name()."',";
            }
            $sql = "INSERT INTO ".$this->tableName." (".rtrim($keys, ',').")"." VALUES"."(".rtrim($values, ',').")";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     *  没有主键
     */
    public function updateByPK($POJO){
    }
    /**
     * 基于复合条件选择字段修改
     * @param $POJO 设置好想要修改的字段
     * @param $POJOExample WHERE的AND OR LIKE条件
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function updateByExample($POJO, $POJOExample){
        if($POJO instanceof Course){
            $this->getConn();
            $id = "";
            if($POJOExample instanceof CourseExample){
                if($POJOExample->getCondition() != ""){
                    $id .= " WHERE ".$POJOExample->getCondition();
                }
            }
            $values = "";
            if($POJO->getCourse_id() != null){
                $values .= "course_id='".$POJO->getCourse_id()."',";
            }
            if($POJO->getCourse_name() != null){
                $values .= "course_name='".$POJO->getCourse_name()."',";
            }
            $sql = "UPDATE ".$this->tableName." SET ".rtrim($values,', ')."$id";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     * 没有主键
     */
    public function deleteByPK($PK){
    }
    /**
     * 根据选择字段删除
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function deleteByExample($POJOExample){
        if($POJOExample instanceof CourseExample){
            $this->getConn();
            $id = "";
            if($POJOExample->getCondition() != ""){
                $id .= " WHERE ".$POJOExample->getCondition();
            }
            $sql = "DELETE FROM ".$this->tableName."$id";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
}
?>
