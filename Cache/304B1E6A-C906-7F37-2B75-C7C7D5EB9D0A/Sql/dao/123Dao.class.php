<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/MySQLConnect.class.php";
require_once BASE_PATH."Sql/interface/SqlDao.interface.php";
require_once BASE_PATH."Sql/pojo/123.class.php";
require_once BASE_PATH."Sql/example/123Example.class.php";
class 123Dao extends SqlDaoInterface{
    private $conn;
    private $tableName = "123";
    /**
     * 获取数据库连接,每次进行数据库操作后关闭数据库连接
     */
    private function getConn(){
        $MysqlConnect = new MysqlConnect();
        $this->conn = $MysqlConnect->getMysqlConnect_Mysqli("13");
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
            $123 = new 123();
            $123->set123($row["123"]);
            $data[] = $123;
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
        if($POJOExample instanceof 123Example){
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
            $123 = new 123();
            $123->set123($row["123"]);
            $data[] = $123;
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
        if($POJO instanceof 123){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->get123() != null){
                $keys .= "123,";
                $values .= "'".$POJO->get123()."',";
            }
            $sql = "INSERT INTO ".$this->tableName." (".rtrim($keys, ',').")"." VALUES"."(".rtrim($values, ',').")";
            $result = mysqli_query($this->conn, $sql);
            if($result == false) die ("Mysql Error: " . $this->conn->error);
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
        if($POJO instanceof 123){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->get123() != null){
                $keys .= "123,";
                $values .= "'".$POJO->get123()."',";
            }
            $sql = "INSERT INTO ".$this->tableName." (".rtrim($keys, ',').")"." VALUES"."(".rtrim($values, ',').")";
            $result = mysqli_query($this->conn, $sql);
            if($result == false) die ("Mysql Error: " . $this->conn->error);
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
        if($POJO instanceof 123){
            $this->getConn();
            $id = "";
            if($POJOExample instanceof 123Example){
                if($POJOExample->getCondition() != ""){
                    $id .= " WHERE ".$POJOExample->getCondition();
                }
            }
            $values = "";
            if($POJO->get123() != null){
                $values .= "123='".$POJO->get123()."',";
            }
            $sql = "UPDATE ".$this->tableName." SET ".rtrim($values,', ')."$id";
            $result = mysqli_query($this->conn, $sql);
            if($result == false) die ("Mysql Error: " . $this->conn->error);
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
        if($POJOExample instanceof 123Example){
            $this->getConn();
            $id = "";
            if($POJOExample->getCondition() != ""){
                $id .= " WHERE ".$POJOExample->getCondition();
            }
            $sql = "DELETE FROM ".$this->tableName."$id";
            $result = mysqli_query($this->conn, $sql);
            if($result == false) die ("Mysql Error: " . $this->conn->error);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
}
?>
