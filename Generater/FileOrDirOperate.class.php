<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."/Generater/Message.class.php";
class FileOrDirOperate{
    public function createDir($path, $flag){
        if (!is_dir($path)){
            $res = mkdir($path, 0777, true); 
            if ($res){
                chmod($path, 0777);
                if($flag == "xml"){
                    echo Message::FileOrDirOperateInfo("目录:$path 创建成功", "green");
                }else if($flag == "web"){

                }
            }else{
                if($flag == "xml"){
                    echo Message::FileOrDirOperateInfo("目录:$path 创建失败", "red");
                }else if($flag == "web"){

                }
            }
        }
    }

    public function createFile($path, $fileName, $fileContent, $flag){
        if (is_dir($path)){
            $filename = $path.$fileName;
            $file = fopen($filename, "w");
            if(is_file($filename)){
                $res = fwrite($file, mb_convert_encoding($fileContent, 'UTF-8', mb_detect_encoding($fileContent)));
                if($res){
                    if($flag == "xml"){
                        echo Message::FileOrDirOperateInfo("文件:$filename 创建成功", "green");
                    }else if($flag == "web"){

                    }
                }else{
                    if($flag == "xml"){
                        echo Message::FileOrDirOperateInfo("文件:$filename 创建失败", "red");
                    }else if($flag == "web"){

                    }
                }
            }
            fclose($file);
        }
    }

    public function delFile($file){
        if(file_exists($file)){
            unlink($file);
        }
    }
    
    public function delDir($dir) {
        if(is_dir($dir)){
            $dh=opendir($dir);
            while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->delDir($fullpath);
                }
            }
            }
            closedir($dh);
            if(rmdir($dir)) {
            return true;
            } else {
            return false;
            }
        }
      }

      public function createGuid() { 
        $guid = '';
        $namespace = rand(11111, 99999);
        $uid = uniqid('', true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
        $guid = substr($hash,  0,  8) . '-' .
                substr($hash,  8,  4) . '-' .
                substr($hash, 12,  4) . '-' .
                substr($hash, 16,  4) . '-' .
                substr($hash, 20, 12);
        return $guid;
    }
}
?>