<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Generater/Table.class.php";
require_once BASE_PATH."Generater/Message.class.php";
require_once BASE_PATH."Generater/customException/XmlNameruleException.class.php";
require_once BASE_PATH."Generater/customException/XmlNullException.class.php";
require_once BASE_PATH."Generater/customException/XmlIsPKException.class.php";
require_once BASE_PATH."Generater/customException/XmlNameRepeatException.class.php";
class ReadData{
    private $tableArray = array();

    public function getTableArray(){
        return $this->tableArray;
    }

    public function webData_Read($tables){
        if(is_array($tables)){
            if(count($tables) > 0){
                for($i = 0; $i < count($tables); $i++){
                    $table = new Table();
                    $dataBaseName = $tables[$i]["databaseName"];
                    if($dataBaseName == "" || !isset($dataBaseName)){
                        return Message::WebInfo("300", "数据库名为空", "", "");
                        break;
                    }else
                        $table->setDataBaseName($dataBaseName);
    
                    $tableName = $tables[$i]["tableName"];
                    if($tableName == "" || !isset($tableName)){
                        return Message::WebInfo("300", "表名为空", "", "");
                        break;
                    }else{
                        for($j = 0; $j < count($this->tableArray); $j++){
                            $tableCase = $this->tableArray[$j];
                            if($tableName == $tableCase->getTableName()){
                                return Message::WebInfo("300", "表名重复", "", "");
                                break;
                            }
                        }
                        $table->setTableName($tableName);
                    }
                    
                    $nameRule = $tables[$i]["nameRule"];
                    $table->setNameRule($nameRule);
                    $primaryKeyArray = $tables[$i]["primaryKeyArray"];
                    if(is_array($primaryKeyArray)){
                        for($j = 0; $j < count($primaryKeyArray); $j++){
                            $table->setPrimaryKeyArray($primaryKeyArray[$j]);
                        }
                    }
                    $fieldNameArray = $tables[$i]["fieldNameArray"];
                    if(is_array($fieldNameArray)){
                        for($k = 0; $k < count($fieldNameArray); $k++){
                            $table->setFieldNameArray($fieldNameArray[$k]);
                        }
                    }
                    $this->tableArray[] = $table;
                }
            }else{
                return Message::WebInfo("300", "error1", "", "");
            }
        }else{
            return Message::WebInfo("300", "数据库名为空或其他错误", "", "");
        }
        return Message::WebInfo("200", "成功", "", "");
    }

    public function simplexml_Read($xmlpath){
        $dataBase = simplexml_load_file($xmlpath);
        $dataBaseName = "";
        try {
            $dataBaseName = (string)$dataBase->attributes()["name"];
        } catch (XmlNullException $e) {
            return $e->errorMessage();
        }
        $tables = $dataBase->children();
        for($i = 0; $i < count($tables); $i++){
            $table = new Table();
            $table->setDataBaseName($dataBaseName);
            $tableName = "";
            try {
                $tableName = (string)$tables[$i]->attributes()["name"];
            } catch (XmlNullException $e) {
                return $e->errorMessage();
            }
            for($j = 0; $j < count($this->tableArray); $j++){
                $tableCase = $this->tableArray[$j];
                if($tableName == $tableCase->getTableName()){
                    throw new XmlNameruleException($tableName);
                    break;
                }
            }
            $table->setTableName($tableName);
            $nameRule = "";
            try {
                $nameRule = (string)$tables[$i]->attributes()["namerule"];
            } catch (XmlNullException $e) {
                return $e->errorMessage();
            }
            if($nameRule == ""){
                $nameRule = "none";
            }
            if($nameRule != "none"){
                if($nameRule != "camelCase"){
                    throw new XmlNameruleException($nameRule);
                }
            }
            $table->setNameRule($nameRule);
            $fieldNameArray = $tables[$i]->children();
            for($k = 0; $k < count($fieldNameArray); $k++){
                $fieldName = "";
                try {
                    $fieldName = (string)$fieldNameArray[$k]->attributes()["name"];
                } catch (XmlNullException $e) {
                    return $e->errorMessage();
                }
                $isPK = (string)$fieldNameArray[$k]->attributes()["isPK"];
                if($isPK == ""){
                    $isPK = "false";
                }
                if($isPK == "TRUE" || $isPK == "True" || $isPK == "true"){
                    $table->setPrimaryKeyArray($fieldName);
                }else if($isPK == "false"){
                    $table->setFieldNameArray($fieldName);
                }else{
                    throw new XmlIsPKException($isPK);
                }
            }
            $this->tableArray[] = $table;
        }
    }
    public function simplexml_newRead($xmlpath){
        $dataBase = simplexml_load_file($xmlpath);
        $dataBaseName = "";
        $servername = "";
        $username = "";
        $password = "";
        $port = "";
        try {
            $dataBaseName = (string)$dataBase->attributes()["name"];
            $servername = (string)$dataBase->attributes()["servername"];
            $username = (string)$dataBase->attributes()["username"];
            $password = (string)$dataBase->attributes()["password"];
            $port = (int)$dataBase->attributes()["port"];
        } catch (XmlNullException $e) {
            return $e->errorMessage();
        }
        $mysqliconn = new mysqli($servername, $username, $password, $dataBaseName, $port);
        if ($mysqliconn->connect_error) {
            die("mysqli连接失败:" . $mysqliconn->connect_error);
        }else{
            $tables = $dataBase->children();
            for($i = 0; $i < count($tables); $i++){
                $table = new Table();
                $table->setDataBaseName($dataBaseName);
                $tableName = "";
                try {
                    $tableName = (string)$tables[$i]->attributes()["name"];
                } catch (XmlNullException $e) {
                    return $e->errorMessage();
                }
                for($j = 0; $j < count($this->tableArray); $j++){
                    $tableCase = $this->tableArray[$j];
                    if($tableName == $tableCase->getTableName()){
                        throw new XmlNameruleException($tableName);
                        break;
                    }
                }
                $table->setTableName($tableName);
                $nameRule = "";
                try {
                    $nameRule = (string)$tables[$i]->attributes()["namerule"];
                } catch (XmlNullException $e) {
                    return $e->errorMessage();
                }
                if($nameRule == ""){
                    $nameRule = "none";
                }
                if($nameRule != "none"){
                    if($nameRule != "camelCase"){
                        throw new XmlNameruleException($nameRule);
                    }
                }
                $table->setNameRule($nameRule);

                $sql = "DESC $tableName";
                $result = mysqli_query($mysqliconn, $sql);
                while($row=$result->fetch_array()){
                    if($row["Key"] == "PRI"){
                        $table->setPrimaryKeyArray($row["Field"]);
                    }else{
                        $table->setFieldNameArray($row["Field"]);
                    }
                }
                $this->tableArray[] = $table;
            }
            mysqli_close($mysqliconn);
        }
    }
}
?>