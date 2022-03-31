<?php
/**
 * SQL连接接口
 * 支持Mysqli或者PDO下各种SQL
 * 目前只写了MySQL的,以后有用到别的数据库再去拓展
 */
abstract class SQLConnectInterface{
    /**
     * 传入参数为数据库名字
     * 会返回一个conn对象
     */
    public abstract function getMysqlConnect_Mysqli($DB_NAME);

    public abstract function getMysqlConnect_PDO($DB_NAME);
}
?>
