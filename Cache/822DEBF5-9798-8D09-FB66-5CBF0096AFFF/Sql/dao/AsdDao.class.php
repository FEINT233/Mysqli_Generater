<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/pojo/Asd.class.php";
require_once BASE_PATH."Sql/example/AsdExample.class.php";
class AsdDao extends SqlDaoInterface{
    private $conn;
    private $tableName = "asd";
    /**
     * 获取数据库连接,每次进行数据库操作后关闭数据库连接
     */
    private function getConn(){
        $MysqlConnect = new MysqlConnect();
        $this->conn = $MysqlConnect->getMysqlConnect_Mysqli("A");
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
            $asd = new Asd();
            $asd->setAa($row["aa"]);
            $data[] = $asd->toArray();
        }
        mysqli_close($this->conn);
        return count($data)!=0?$data:0;
    }
    /**
     * 根据id查询
     * 如果有信息返回对象,否则返回null
     * @param 当表主键只有一个时参数为$PK 可直接输入主键参数 
     * @param 当表主键有多个时参数为$POJO 一个对应的po对象,创建对象时需设置对应主键参数 
     * @return 返回一个对应的po对象 
     */
    public function selectByPK($PK){
        $this->getConn();
        $id = "";
        $id = "aa = '$PK'";
        $sql = "SELECT * FROM $this->tableName WHERE $id";
        $result = mysqli_query($this->conn, $sql);
        $asd = null;
        while($row=$result->fetch_array()){
            $asd = new Asd();
            $asd->setAa($row["aa"]);
        }
        mysqli_close($this->conn);
        return $asd!=null?$asd:null;
    }
    /**
     * 根据选择字段查询
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return $data不为0时返回存储对应类型po对象的数组,否则返回0
     */
    public function selectByExample($POJOExample){
        if($POJOExample instanceof AsdExample){
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
            $asd = new Asd();
            $asd->setAa($row["aa"]);
            $data[] = $asd->toArray();
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
        if($POJO instanceof Asd){
            $this->getConn();
            $values = "";
            $values .= "'".$POJO->getAa()."',";
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
        if($POJO instanceof Asd){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->getAa() != null){
                $keys .= "aa,";
                $values .= "'".$POJO->getAa()."',";
            }
            $sql = "INSERT INTO ".$this->tableName." (".rtrim($keys, ',').")"." VALUES"."(".rtrim($values, ',').")";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     *  根据主键选择字段修改
     * @param $POJO 需把主键变量都设置好,并设置好想要修改的字段
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function updateByPK($POJO){
        if($POJO instanceof Asd){
            $this->getConn();
            $id = "";
            $id = "aa = '$POJO->getAa()'";
            $values = "";
            if($POJO->getAa() != null){
                $values .= "aa='".$POJO->getAa()."',";
            }
            $sql = "UPDATE ".$this->tableName." SET ".rtrim($values,', ')." WHERE $id";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     * 基于复合条件选择字段修改
     * @param $POJO 设置好想要修改的字段
     * @param $POJOExample WHERE的AND OR LIKE条件
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function updateByExample($POJO, $POJOExample){
        if($POJO instanceof Asd){
            $this->getConn();
            $id = "";
            if($POJOExample instanceof AsdExample){
                if($POJOExample->getCondition() != ""){
                    $id .= " WHERE ".$POJOExample->getCondition();
                }
            }
            $id = "aa = 'aa'";
            $values = "";
            if($POJO->getAa() != null){
                $values .= "aa='".$POJO->getAa()."',";
            }
            $sql = "UPDATE ".$this->tableName." SET ".rtrim($values,', ')."$id";
            $result = mysqli_query($this->conn, $sql);
            mysqli_close($this->conn);
            return $result;
        }
        return false;
    }
    /**
     * 根据主键删除
     * @param 当表主键只有一个时参数为$PK 可直接输入主键参数 
     * @param 当表主键有多个时参数为$POJO 一个对应的po对象,创建对象时需设置对应主键参数 
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function deleteByPK($PK){
        $this->getConn();
        $id = "";
        $id ="aa = '$PK'";
        $sql = "DELETE FROM ".$this->tableName." WHERE $id";
        $result = mysqli_query($this->conn, $sql);
        mysqli_close($this->conn);
        return $result;
    }
    /**
     * 根据选择字段删除
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function deleteByExample($POJOExample){
        if($POJOExample instanceof AsdExample){
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
