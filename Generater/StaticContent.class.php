<?php

class StaticContent{

    public function MySQLConfigInterfaceContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * mysql配置信息接口,起到规范作用".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "abstract class MySQLConfigInterface{".PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 获取数据库地址".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function getServername();".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 获取数据库用户名".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function getUsername();".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 获取数据库密码".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function getPassword();".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function SQLConnectInterfaceContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * SQL连接接口".PHP_EOL;
        $content .= " * 支持Mysqli或者PDO下各种SQL".PHP_EOL;
        $content .= " * 目前只写了MySQL的,以后有用到别的数据库再去拓展".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "abstract class SQLConnectInterface{".PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 传入参数为数据库名字".PHP_EOL;
        $content .= "     * 会返回一个conn对象".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function getMysqlConnect_Mysqli(\$DB_NAME);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public abstract function getMysqlConnect_PDO(\$DB_NAME);".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function SqlExampleInterfaceContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * sqlExample操作拓展接口类".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "abstract class SqlExampleInterface{".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * WHERE条件中附加AND, 或者只填写一个表字段".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function And(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * WHERE条件中附加OR, 或者只填写一个表字段".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function Or(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * WHERE条件中附加LIKE和AND, 或者只填写一个表字段LIKE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function AndLike(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * WHERE条件中附加LIKE和OR, 或者只填写一个表字段LIKE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function OrLike(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * SELECT WHERE条件中附加排序,需自行填写ASC或DESC".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function OrderBy(\$kind);".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function SqlDaoInterfaceContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * sql操作接口类".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "abstract class SqlDaoInterface{".PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 传入参数为数据库名字".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function select();".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据主键查询".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function selectByPK(\$PK);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据选择字段查询,用POJOExample类来更详细的设置".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function selectByExample(\$POJOExample);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 全字段插入".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function insert(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 选择字段插入,数据库有的字段不是必填的,可以为null".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function insertByExample(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据主键选择字段修改".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function updateByPK(\$POJO);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 选择字段修改,用POJOExample类来对WHERE条件进行更详细的设置".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function updateByExample(\$POJO, \$POJOExample);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据主键删除".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function deleteByPK(\$PK);".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据选择字段删除".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public abstract function deleteByExample(\$POJOExample);".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function MySQLConfigContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * Mysql配置文件,保存了服务器地址,用户名 和密码".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "define('BASE_PATH',str_replace('\\\\','/',realpath(dirname(__FILE__).'/../')).\"/\");".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/interface/MySQLConfig.interface.php\";".PHP_EOL;
        $content .= "class MySQLConfig extends MySQLConfigInterface{".PHP_EOL;
        $content .= "    public function getServername(){".PHP_EOL;
        $content .= "        return \"localhost\";".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getUsername(){".PHP_EOL;
        $content .= "        return \"root\";".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getPassword(){".PHP_EOL;
        $content .= "        return \"123456\";".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function MySQLConnectContent(){
        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "/**".PHP_EOL;
        $content .= " * Mysql连接".PHP_EOL;
        $content .= " */".PHP_EOL;
        $content .= "define('BASE_PATH',str_replace('\\\\','/',realpath(dirname(__FILE__).'/../')).\"/\");".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/MySQLConfig.class.php\";".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/interface/SQLConnect.interface.php\";".PHP_EOL;
        $content .= "class MysqlConnect extends SQLConnectInterface{".PHP_EOL;
        $content .= "    private \$servername;".PHP_EOL;
        $content .= "    private \$username;".PHP_EOL;
        $content .= "    private \$password;".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    private function setMysqlConfig(){".PHP_EOL;
        $content .= "        \$mysqlConfig = new MySQLConfig();".PHP_EOL;
        $content .= "        \$this->servername = \$mysqlConfig->getServername();".PHP_EOL;
        $content .= "        \$this->username = \$mysqlConfig->getUsername();".PHP_EOL;
        $content .= "        \$this->password = \$mysqlConfig->getPassword();".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getMysqlConnect_Mysqli(\$DB_NAME){".PHP_EOL;
        $content .= "        \$this->setMysqlConfig();".PHP_EOL;
        $content .= "        \$mysqliconn = new mysqli(\$this->servername, \$this->username, \$this->password, \$DB_NAME);".PHP_EOL;
        $content .= "        if (\$mysqliconn->connect_error) {".PHP_EOL;
        $content .= "            die(\"mysqli连接失败:\" . \$mysqliconn->connect_error);".PHP_EOL;
        $content .= "            return null;".PHP_EOL;
        $content .= "        }else return \$mysqliconn;".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getMysqlConnect_PDO(\$DB_NAME){".PHP_EOL;
        $content .= "        \$this->setMysqlConfig();".PHP_EOL;
        $content .= "        try {".PHP_EOL;
        $content .= "            \$PDOconn = new PDO(\"mysql:host=\$this->servername;dbname=\$DB_NAME\", \$this->username, \$this->password);".PHP_EOL;
        $content .= "            return \$PDOconn;".PHP_EOL;
        $content .= "        }catch(PDOException \$e){".PHP_EOL;
        $content .= "            return null;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }
}
?>