<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../../'))."/");
require_once BASE_PATH."Sql/MySQLConnect.class.php";
require_once BASE_PATH."Sql/interface/SqlDao.interface.php";
require_once BASE_PATH."Sql/pojo/FilmActor.class.php";
require_once BASE_PATH."Sql/example/FilmActorExample.class.php";
class FilmActorDao extends SqlDaoInterface{
    private $conn;
    private $tableName = "film_actor";
    /**
     * 获取数据库连接,每次进行数据库操作后关闭数据库连接
     */
    private function getConn(){
        $MysqlConnect = new MysqlConnect();
        $this->conn = $MysqlConnect->getMysqlConnect_Mysqli("sakila");
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
            $filmActor = new FilmActor();
            $filmActor->setActorId($row["actor_id"]);
            $filmActor->setFilmId($row["film_id"]);
            $filmActor->setLastUpdate($row["last_update"]);
            $data[] = $filmActor;
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
    public function selectByPK($POJO){
        $this->getConn();
        $id = "";
        if($POJO instanceof FilmActor){
            if($POJO->getActorId() != null){
                $id .= "actor_id = '".$POJO->getActorId()."' AND ";
            }
            if($POJO->getFilmId() != null){
                $id .= "film_id = '".$POJO->getFilmId()."' AND ";
            }
            $id = rtrim($id,' AND ');
        }
        $sql = "SELECT * FROM $this->tableName WHERE $id";
        $result = mysqli_query($this->conn, $sql);
        $filmActor = null;
        while($row=$result->fetch_array()){
            $filmActor = new FilmActor();
            $filmActor->setActorId($row["actor_id"]);
            $filmActor->setFilmId($row["film_id"]);
            $filmActor->setLastUpdate($row["last_update"]);
        }
        mysqli_close($this->conn);
        return $filmActor!=null?$filmActor:null;
    }
    /**
     * 根据选择字段查询
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return $data不为0时返回存储对应类型po对象的数组,否则返回0
     */
    public function selectByExample($POJOExample){
        if($POJOExample instanceof FilmActorExample){
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
            $filmActor = new FilmActor();
            $filmActor->setActorId($row["actor_id"]);
            $filmActor->setFilmId($row["film_id"]);
            $filmActor->setLastUpdate($row["last_update"]);
            $data[] = $filmActor;
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
        if($POJO instanceof FilmActor){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->getActorId() != null){
                $keys .= "actor_id,";
                $values .= "'".$POJO->getActorId()."',";
            }
            if($POJO->getFilmId() != null){
                $keys .= "film_id,";
                $values .= "'".$POJO->getFilmId()."',";
            }
            if($POJO->getLastUpdate() != null){
                $keys .= "last_update,";
                $values .= "'".$POJO->getLastUpdate()."',";
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
        if($POJO instanceof FilmActor){
            $this->getConn();
            $keys = "";
            $values = "";
            if($POJO->getActorId() != null){
                $keys .= "actor_id,";
                $values .= "'".$POJO->getActorId()."',";
            }
            if($POJO->getFilmId() != null){
                $keys .= "film_id,";
                $values .= "'".$POJO->getFilmId()."',";
            }
            if($POJO->getLastUpdate() != null){
                $keys .= "last_update,";
                $values .= "'".$POJO->getLastUpdate()."',";
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
     *  根据主键选择字段修改
     * @param $POJO 需把主键变量都设置好,并设置好想要修改的字段
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function updateByPK($POJO){
        if($POJO instanceof FilmActor){
            $this->getConn();
            $id = "";
            if($POJO->getActorId() != null){
                $id .= "actor_id = '".$POJO->getActorId()."' AND ";
            }
            if($POJO->getFilmId() != null){
                $id .= "film_id = '".$POJO->getFilmId()."' AND ";
            }
            $id = rtrim($id,' AND ');
            $values = "";
            if($POJO->getActorId() != null){
                $values .= "actor_id='".$POJO->getActorId()."',";
            }
            if($POJO->getFilmId() != null){
                $values .= "film_id='".$POJO->getFilmId()."',";
            }
            if($POJO->getLastUpdate() != null){
                $values .= "last_update='".$POJO->getLastUpdate()."',";
            }
            $sql = "UPDATE ".$this->tableName." SET ".rtrim($values,', ')." WHERE $id";
            $result = mysqli_query($this->conn, $sql);
            if($result == false) die ("Mysql Error: " . $this->conn->error);
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
        if($POJO instanceof FilmActor){
            $this->getConn();
            $id = "";
            if($POJOExample instanceof FilmActorExample){
                if($POJOExample->getCondition() != ""){
                    $id .= " WHERE ".$POJOExample->getCondition();
                }
            }
            $values = "";
            if($POJO->getActorId() != null){
                $values .= "actor_id='".$POJO->getActorId()."',";
            }
            if($POJO->getFilmId() != null){
                $values .= "film_id='".$POJO->getFilmId()."',";
            }
            if($POJO->getLastUpdate() != null){
                $values .= "last_update='".$POJO->getLastUpdate()."',";
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
     * 根据主键删除
     * @param 当表主键只有一个时参数为$PK 可直接输入主键参数 
     * @param 当表主键有多个时参数为$POJO 一个对应的po对象,创建对象时需设置对应主键参数 
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function deleteByPK($POJO){
        $this->getConn();
        $id = "";
        if($POJO instanceof FilmActor){
            if($POJO->getActorId() != null){
                $id .= "actor_id = '".$POJO->getActorId()."' AND ";
            }
            if($POJO->getFilmId() != null){
                $id .= "film_id = '".$POJO->getFilmId()."' AND ";
            }
            $id = rtrim($id,' AND ');
        }
        $sql = "DELETE FROM ".$this->tableName." WHERE $id";
        $result = mysqli_query($this->conn, $sql);
        if($result == false) die ("Mysql Error: " . $this->conn->error);
        mysqli_close($this->conn);
        return $result;
    }
    /**
     * 根据选择字段删除
     * @param $POJOExample 设置对应表多个条件的参数对象
     * @return 根据SQL操作返回TRUE或者FALSE
     */
    public function deleteByExample($POJOExample){
        if($POJOExample instanceof FilmActorExample){
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
