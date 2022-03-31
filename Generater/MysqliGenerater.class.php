<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Generater/Table.class.php";
require_once BASE_PATH."Generater/FileOrDirOperate.class.php";
require_once BASE_PATH."Generater/ReadData.class.php";
require_once BASE_PATH."Generater/StaticContent.class.php";
require_once BASE_PATH."Generater/DynamicContent.class.php";

class MysqliGenerater{

    public function MysqliGeneraterForWeb($tables, $path){
        $readData = new ReadData();
        $result = $readData->webData_Read($tables);
        if($result["code"] == 200){
            $this->MysqliGeneraterEntrance($readData->getTableArray(), $path."/Sql", "web");
            return Message::WebInfo("200", "success", "", "");
        }else{
            return $result;
        }
        return Message::WebInfo("300", "WEB11", "", "");
    }

    public function MysqliGeneraterForXML($xmlpath){
        $readData = new ReadData();
        $readData->simplexml_Read($xmlpath);
        $this->MysqliGeneraterEntrance($readData->getTableArray(), "Sql", "xml");
    }

    public function MysqliGeneraterForNewXML($xmlpath){
        $readData = new ReadData();
        $readData->simplexml_newRead($xmlpath);
        $this->MysqliGeneraterEntrance($readData->getTableArray(), "Sql", "xml");
    }

    private function MysqliGeneraterEntrance($tableArray, $path, $flag){
        $staticContent = new StaticContent();
        $dynamicContent = new DynamicContent();
        $fileOrDirOperate = new FileOrDirOperate();

        $fileOrDirOperate->createDir(BASE_PATH.$path."/interface/", $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/interface/", "MySQLConfig.interface.php", $staticContent->MySQLConfigInterfaceContent(), $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/interface/", "SQLConnect.interface.php", $staticContent->SQLConnectInterfaceContent(), $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/interface/", "SqlExample.interface.php", $staticContent->SqlExampleInterfaceContent(), $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/interface/", "SqlDao.interface.php", $staticContent->SqlDaoInterfaceContent(), $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/", "MySQLConfig.class.php", $staticContent->MySQLConfigContent(), $flag);
        $fileOrDirOperate->createFile(BASE_PATH.$path."/", "MySQLConnect.class.php", $staticContent->MySQLConnectContent(), $flag);
        
        $fileOrDirOperate->createDir(BASE_PATH.$path."/pojo/", $flag);
        for($i = 0; $i < count($tableArray); $i++){
            $table = $tableArray[$i];
            $fileName = $this->getFileName($table, "", $dynamicContent);
            $fileOrDirOperate->createFile(BASE_PATH.$path."/pojo/", $fileName, $dynamicContent->pojoContent($table), $flag);
        }

        $fileOrDirOperate->createDir(BASE_PATH.$path."/example/", $flag);
        for($i = 0; $i < count($tableArray); $i++){
            $table = $tableArray[$i];
            $fileName = $this->getFileName($table, "Example", $dynamicContent);
            $fileOrDirOperate->createFile(BASE_PATH.$path."/example/", $fileName, $dynamicContent->pojoExampleContent($table), $flag);
        }

        $fileOrDirOperate->createDir(BASE_PATH.$path."/dao/", $flag);
        for($i = 0; $i < count($tableArray); $i++){
            $table = $tableArray[$i];
            $fileName = $this->getFileName($table, "Dao", $dynamicContent);
            $fileOrDirOperate->createFile(BASE_PATH.$path."/dao/", $fileName, $dynamicContent->pojoDaoContent($table), $flag);
        }
    }

    private function getFileName($table, $suffix, $dynamicContent){
        $fileName = "";
        $nameRule = 0;
        if(strcmp($table->getNameRule(), "camelCase") == 0)
            $nameRule = 1;
        if($nameRule)
            $fileName = $dynamicContent->camelCaseConvert($table->getTableName(), 1);
        else
            $fileName = ucfirst($table->getTableName());
        return $fileName.$suffix.".class.php";
    }
}

?>