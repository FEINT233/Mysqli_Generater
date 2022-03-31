<?php
/**
 * Mysql连接
 */
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Sql/MySQLConfig.class.php";
require_once BASE_PATH."Sql/interface/SQLConnect.interface.php";
class MysqlConnect extends SQLConnectInterface{
    private $servername;
    private $username;
    private $password;

    private function setMysqlConfig(){
        $mysqlConfig = new MySQLConfig();
        $this->servername = $mysqlConfig->getServername();
        $this->username = $mysqlConfig->getUsername();
        $this->password = $mysqlConfig->getPassword();
    }

    public function getMysqlConnect_Mysqli($DB_NAME){
        $this->setMysqlConfig();
        $mysqliconn = new mysqli($this->servername, $this->username, $this->password, $DB_NAME);
        if ($mysqliconn->connect_error) {
            die("mysqli连接失败:" . $mysqliconn->connect_error);
            return null;
        }else return $mysqliconn;
    }

    public function getMysqlConnect_PDO($DB_NAME){
        $this->setMysqlConfig();
        try {
            $PDOconn = new PDO("mysql:host=$this->servername;dbname=$DB_NAME", $this->username, $this->password);
            return $PDOconn;
        }catch(PDOException $e){
            return null;
        }
    }
}
?>
