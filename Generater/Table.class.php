<?php
class Table{
    private $dataBaseName;
    private $tableName;
    private $nameRule;
    private $primaryKeyArray = array();
    private $fieldNameArray = array();

    public function getDataBaseName(){
        return $this->dataBaseName;
    }

    public function setDataBaseName($dataBaseName){
        $this->dataBaseName = $dataBaseName;
    }

    public function getTableName(){
        return $this->tableName;
    }

    public function setTableName($tableName){
        $this->tableName = $tableName;
    }

    public function getNameRule(){
        return $this->nameRule;
    }

    public function setNameRule($nameRule){
        $this->nameRule = $nameRule;
    }

    public function getPrimaryKeyArray(){
        return $this->primaryKeyArray;
    }

    public function setPrimaryKeyArray($primaryKey){
        $this->primaryKeyArray[] = $primaryKey;
    }

    public function getFieldNameArray(){
        return $this->fieldNameArray;
    }

    public function setFieldNameArray($fieldName){
        $this->fieldNameArray[] = $fieldName;
    }

}
?>