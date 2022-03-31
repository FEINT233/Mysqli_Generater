<?php
/**
 * mysql配置信息接口,起到规范作用
 * mysql配置信息接口,起到规范作用
 */
abstract class MySQLConfigInterface{
    /**
     * 获取数据库地址
     */
    public abstract function getLocalhost();

    /**
     * 获取数据库用户名
     */
    public abstract function getUsername();

    /**
     * 获取数据库密码
     */
    public abstract function getPassword();
}
?>
