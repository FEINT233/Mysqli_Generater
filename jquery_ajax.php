<?php
error_reporting(E_ALL & ~E_NOTICE);
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");
require_once BASE_PATH."Test/MysqliGenerater.class.php";

    $a = new FileOrDirOperate();
    $guid = $a->createGuid();
    while(TRUE){
        if(file_exists(BASE_PATH."Cache/".$guid.".zip")){
            $guid = $a->createGuid();
        }else{
            break;
        }
    }

    $tableArray = $_POST["tableArray"];
    $mysqliGenerater = new MysqliGenerater();
    $result = $mysqliGenerater->MysqliGeneraterForWeb($tableArray, "Cache/".$guid);
    if($result["code"] == 200){
        Zip(BASE_PATH."Cache/".$guid, BASE_PATH."Cache/".$guid.".zip");
        if(file_exists(BASE_PATH."Cache/".$guid.".zip")){
            echo json_encode(Message::WebInfo("200", "成功", "download.php/?guid=".$guid, $guid));
        }else{
            echo json_encode(Message::WebInfo("300", "失败", "", ""));
        }
    }else{
        echo json_encode($result);
    }
    
    function Zip($path, $zipName){
        $rootPath = realpath($path);
        $zip = new ZipArchive();
        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // 返回的是一个数组，里面都是SplFileInfo类
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file){
            if (!$file->isDir()){
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
    }

?>