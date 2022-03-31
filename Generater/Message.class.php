<?php

use LDAP\Result;

class Message{
    public static function FileOrDirOperateInfo($Message, $color){
        date_default_timezone_set('PRC');
        return "[".date("Y-m-d H:i:s", time())."]"."<font color='$color' >$Message</font>"."<br>";
    }

    public static function WebInfo($code, $msg, $link, $guid){
        $result = array();
        $result["code"] = $code;
        $result["msg"] = $msg;
        $result["link"] = $link;
        $result["guid"] = $guid;
        return $result;
    }
}
?>