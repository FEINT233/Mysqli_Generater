<?php
/**
 * Mysql配置文件,保存了服务器地址,用户名 和密码
 */
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Sql/interface/MySQLConfig.interface.php";
class MySQLConfig extends MySQLConfigInterface{
    public function getServername(){
        return "localhost";
    }

    public function getUsername(){
        return "root";
    }

    public function getPassword(){
        return "123456";
    }
}
?>
