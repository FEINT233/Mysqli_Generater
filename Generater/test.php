<?php 
error_reporting(E_ALL & ~E_NOTICE);
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Generater/Message.class.php";
require_once BASE_PATH."Generater/MysqliGenerater.class.php";
require_once BASE_PATH."Generater/ReadData.class.php";
/**
 * 整体创建流程的可视化？
 * 
 * 目录或文件创建失败的定位
 **/

// function writeFile($path, $filename, $fileContent){
//     if (is_dir($path)){
//         $filename = $path.$filename;
//         $file = fopen($filename, "w");
//         if(is_file($filename)){
//             $res = fwrite($file, mb_convert_encoding($fileContent, 'UTF-8', mb_detect_encoding($fileContent)));
//             if($res){
//                 echo Message::FileOrDirOperateInfo("文件:$filename 创建成功", "green");
//             }else{
//                 echo Message::FileOrDirOperateInfo("文件:$filename 创建失败", "red");
//             }
//         }
//         fclose($file);
//     }else{
//         $res = mkdir($path, 0777, true); 
//         if ($res){
//             chmod($path, 0777);
//             echo Message::FileOrDirOperateInfo("目录:$path 创建成功", "green");
//         }else{
//             echo Message::FileOrDirOperateInfo("目录:$path 创建失败", "red");
//         }
//     }
// }

$mysqliGenerater = new MysqliGenerater();
$mysqliGenerater->MysqliGeneraterForNewXML("xml3.xml");
// function camelCaseConvert($name, $flag){
//     $newName = "";
//     $pattern = "/[\s,\/_\.\-;$\\\\]+/";
//     if($flag) $name = ucfirst($name);
//     for($i = 0; $i < strlen($name); $i++){
//         if(preg_match($pattern, $name[$i]) > 0  && preg_match("/^[A-Za-z]+$/", $name[$i+1]) > 0 && isset($name[$i+1])){
//             $name[$i+1] = strtoupper($name[$i+1]);
//         }
//     }
//     $newName = preg_replace($pattern, "", $name);
//     return $newName;
// }
// $name = camelCaseConvert("stu_id", 0);
// $a = new ReadData();
// $a->simplexml_Read("xml1.xml");
// echo var_dump($a->getTableArray());


?>