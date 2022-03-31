<?php
/**
 * sql操作接口类
 */
abstract class SqlDaoInterface{
    /**
     * 传入参数为数据库名字
     */
    public abstract function select();

    /**
     * 根据主键查询
     */
    public abstract function selectByPK($PK);

    /**
     * 根据选择字段查询,用POJOExample类来更详细的设置
     */
    public abstract function selectByExample($POJOExample);

    /**
     * 全字段插入
     */
    public abstract function insert($POJO);

    /**
     * 选择字段插入,数据库有的字段不是必填的,可以为null
     */
    public abstract function insertByExample($POJO);

    /**
     * 根据主键选择字段修改
     */
    public abstract function updateByPK($POJO);

    /**
     * 选择字段修改,用POJOExample类来对WHERE条件进行更详细的设置
     */
    public abstract function updateByExample($POJO, $POJOExample);

    /**
     * 根据主键删除
     */
    public abstract function deleteByPK($PK);

    /**
     * 根据选择字段删除
     */
    public abstract function deleteByExample($POJOExample);
}
?>
