<?php
/**
 * sqlExample操作拓展接口类
 */
abstract class SqlExampleInterface{

    /**
     * WHERE条件中附加AND, 或者只填写一个表字段
     */
    public abstract function And($POJO);

    /**
     * WHERE条件中附加OR, 或者只填写一个表字段
     */
    public abstract function Or($POJO);

    /**
     * WHERE条件中附加LIKE和AND, 或者只填写一个表字段LIKE
     */
    public abstract function AndLike($POJO);

    /**
     * WHERE条件中附加LIKE和OR, 或者只填写一个表字段LIKE
     */
    public abstract function OrLike($POJO);

    /**
     * SELECT WHERE条件中附加排序,需自行填写ASC或DESC
     */
    public abstract function OrderBy($kind);
}
?>
