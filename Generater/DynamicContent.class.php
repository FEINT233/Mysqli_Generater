<?php
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/../'))."/");
require_once BASE_PATH."Generater/Table.class.php";
class DynamicContent{
    public function pojoContent($table){
        $nameRule = 0;
        $tableName = $table->getTableName();
        $primaryKeyArray = $table->getPrimaryKeyArray();
        $primaryKeyCount = count($primaryKeyArray);
        $fieldNameArray = $table->getFieldNameArray();
        $fieldNameCount = count($fieldNameArray);

        $content = "";
        $content .= "<?php".PHP_EOL;
        if($table->getNameRule() == "camelCase") $nameRule = 1;
        if($nameRule)
            $content .= "class ".$this->camelCaseConvert($tableName, 1)." implements JsonSerializable{".PHP_EOL;
        else
            $content .= "class ".ucfirst($tableName)." implements JsonSerializable{".PHP_EOL;
        
        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstLowercase = $this->camelCaseConvert($primaryKeyArray[$i], 0);
                    $content .= "    private \$".$primaryKeyFirstLowercase.";".PHP_EOL;
                }else{
                    $primaryKeyFirstLowercase = $primaryKeyArray[$i];
                    $content .= "    private \$".$primaryKeyFirstLowercase.";".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstLowercase = $this->camelCaseConvert($fieldNameArray[$i], 0);
                    $content .= "    private \$".$fieldNameFirstLowercase.";".PHP_EOL;
                }else{
                    $fieldNameFirstLowercase = $fieldNameArray[$i];
                    $content .= "    private \$".$fieldNameFirstLowercase.";".PHP_EOL;
                }
            }
        }

        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstLowercase = $this->camelCaseConvert($primaryKeyArray[$i], 0);
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "    public function get".$primaryKeyFirstCapital."(){".PHP_EOL;
                    $content .= "        return \$this->".$primaryKeyFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                    $content .= "    public function set".$primaryKeyFirstCapital."(\$".$primaryKeyFirstLowercase."){".PHP_EOL;
                    $content .= "        \$this->".$primaryKeyFirstLowercase."= \$".$primaryKeyFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                }else{
                    $primaryKeyFirstLowercase = $primaryKeyArray[$i];
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "    public function get".$primaryKeyFirstCapital."(){".PHP_EOL;
                    $content .= "        return \$this->".$primaryKeyFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                    $content .= "    public function set".$primaryKeyFirstCapital."(\$".$primaryKeyFirstLowercase."){".PHP_EOL;
                    $content .= "        \$this->".$primaryKeyFirstLowercase."= \$".$primaryKeyFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstLowercase = $this->camelCaseConvert($fieldNameArray[$i], 0);
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "    public function get".$fieldNameFirstCapital."(){".PHP_EOL;
                    $content .= "        return \$this->".$fieldNameFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                    $content .= "    public function set".$fieldNameFirstCapital."(\$".$fieldNameFirstLowercase."){".PHP_EOL;
                    $content .= "        \$this->".$fieldNameFirstLowercase."= \$".$fieldNameFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                }else{
                    $fieldNameFirstLowercase = $fieldNameArray[$i];
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "    public function get".$fieldNameFirstCapital."(){".PHP_EOL;
                    $content .= "        return \$this->".$fieldNameFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                    $content .= "    public function set".$fieldNameFirstCapital."(\$".$fieldNameFirstLowercase."){".PHP_EOL;
                    $content .= "        \$this->".$fieldNameFirstLowercase."= \$".$fieldNameFirstLowercase.";".PHP_EOL;
                    $content .= "    }".PHP_EOL;
                    $content .= PHP_EOL;
                }
            }
        }

        $content .= "    public function jsonSerialize(){".PHP_EOL;
        $content .= "        \$data = [];".PHP_EOL;
        $content .= "        foreach (\$this as \$key=>\$val){".PHP_EOL;
        $content .= "            if (\$val !== null) \$data[\$key] = \$val;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return \$data;".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        $content .= "    public function toString(){".PHP_EOL;

        if($nameRule)
            $content .= "        \$string = \"{".$this->camelCaseConvert($tableName, 1).": \".\"{\";".PHP_EOL;
        else
            $content .= "        \$string = \"{".ucfirst($tableName).": \".\"{\";".PHP_EOL;
                
        $content .= "        foreach (\$this as \$key=>\$val){".PHP_EOL;
        $content .= "            if (\$val !== null){".PHP_EOL;
        $content .= "                if(gettype(\$val) === \"string\") \$string .= \$key.\" : '\".\$val.\"', \";".PHP_EOL;
        $content .= "                else if(gettype(\$val) === \"integer\") \$string .= \$key.\" : \".\$val.\", \";".PHP_EOL;
        $content .= "            }".PHP_EOL;
        $content .= "            else \$string .= \$key.\" : null, \";".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        \$string = rtrim(\$string,', ');".PHP_EOL;
        $content .= "        return \$string.\"}\".\"}\";".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function pojoExampleContent($table){
        $nameRule = 0;
        $tableName = $table->getTableName();
        if($table->getNameRule() == "camelCase") $nameRule = 1;

        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "define('BASE_PATH',str_replace('\\\\','/',realpath(dirname(__FILE__).'/../../')).\"/\");".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/interface/SqlExample.interface.php\";".PHP_EOL;
        if($nameRule)
            $content .= "require_once BASE_PATH.\"Sql/pojo/".$this->camelCaseConvert($tableName, 1).".class.php\";".PHP_EOL;
        else
            $content .= "require_once BASE_PATH.\"Sql/pojo/".ucfirst($tableName).".class.php\";".PHP_EOL;

        if($nameRule)
            $content .= "class ".$this->camelCaseConvert($tableName, 1)."Example extends SqlExampleInterface{".PHP_EOL;
        else
            $content .= "class ".ucfirst($tableName)."Example extends SqlExampleInterface{".PHP_EOL;
                
        $content .= "    private \$condition = \"\"; //where ()".PHP_EOL;
        $content .= "    private \$kind = \"\";      //Order by; ".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getCondition(){".PHP_EOL;
        $content .= "        return \$this->condition;".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        $content .= "    public function getKind(){".PHP_EOL;
        $content .= "        return \$this->kind;" .PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;
        
        if($nameRule)
            $content .= "    public function And(\$".$this->camelCaseConvert($tableName, 0)."){".PHP_EOL;
        else
            $content .= "    public function And(\$".$tableName."){".PHP_EOL;

        if($nameRule)
            $content .= "       \$this->clause(\$".$this->camelCaseConvert($tableName, 0).", \"=\", \"AND\");".PHP_EOL;
        else
            $content .= "       \$this->clause(\$$tableName, \"=\", \"AND\");".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        if($nameRule)
            $content .= "    public function Or(\$".$this->camelCaseConvert($tableName, 0)."){".PHP_EOL;
        else
            $content .= "    public function Or(\$".$tableName."){".PHP_EOL;

        if($nameRule)
            $content .= "       \$this->clause(\$".$this->camelCaseConvert($tableName, 0).", \"=\", \"OR\");".PHP_EOL;
        else
            $content .= "       \$this->clause(\$$tableName, \"=\", \"OR\");".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        if($nameRule)
            $content .= "    public function AndLike(\$".$this->camelCaseConvert($tableName, 0)."){".PHP_EOL;
        else
            $content .= "    public function AndLike(\$".$tableName."){".PHP_EOL;

        if($nameRule)
            $content .= "       \$this->clause(\$".$this->camelCaseConvert($tableName, 0).", \"LIKE\", \"AND\");".PHP_EOL;
        else
            $content .= "       \$this->clause(\$$tableName, \"LIKE\", \"AND\");".PHP_EOL;
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        if($nameRule)
            $content .= "    public function OrLike(\$".$this->camelCaseConvert($tableName, 0)."){".PHP_EOL;
        else
            $content .= "    public function OrLike(\$".$tableName."){".PHP_EOL;

        if($nameRule)
            $content .= "       \$this->clause(\$".$this->camelCaseConvert($tableName, 0).", \"LIKE\", \"OR\");".PHP_EOL;
        else
            $content .= "       \$this->clause(\$$tableName, \"LIKE\", \"OR\");".PHP_EOL;
                
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        if($nameRule)
            $content .= "    private function clause(\$".$this->camelCaseConvert($tableName, 0).", \$operate, \$Lword){".PHP_EOL;
        else
            $content .= "    private function clause(\$".$tableName.", \$operate, \$Lword){".PHP_EOL;
        $content .= $this->ConditionContent($table, $nameRule);
        $content .= "    }".PHP_EOL;
        $content .= PHP_EOL;

        $content .= "    public function OrderBy(\$kind){".PHP_EOL;
        $content .= "        \$this->kind = \" ORDER BY \".\$kind;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    public function pojoDaoContent($table){
        $nameRule = 0;
        if($table->getNameRule() == "camelCase") $nameRule = 1;
        $tableName = $table->getTableName();
        $primaryKeyArray = $table->getPrimaryKeyArray();
        $primaryKeyCount = count($primaryKeyArray);
        $fieldNameArray = $table->getFieldNameArray();
        $fieldNameCount = count($fieldNameArray);

        $content = "";
        $content .= "<?php".PHP_EOL;
        $content .= "define('BASE_PATH',str_replace('\\\\','/',realpath(dirname(__FILE__).'/../../')).\"/\");".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/MySQLConnect.class.php\";".PHP_EOL;
        $content .= "require_once BASE_PATH.\"Sql/interface/SqlDao.interface.php\";".PHP_EOL;
        if($nameRule)
            $content .= "require_once BASE_PATH.\"Sql/pojo/".$this->camelCaseConvert($tableName, 1).".class.php\";".PHP_EOL;
        else
            $content .= "require_once BASE_PATH.\"Sql/pojo/".ucfirst($tableName).".class.php\";".PHP_EOL;
        if($nameRule)
            $content .= "require_once BASE_PATH.\"Sql/example/".$this->camelCaseConvert($tableName, 1)."Example.class.php\";".PHP_EOL;
        else
            $content .= "require_once BASE_PATH.\"Sql/example/".ucfirst($tableName)."Example.class.php\";".PHP_EOL;

        if($nameRule)
            $content .= "class ".$this->camelCaseConvert($tableName, 1)."Dao extends SqlDaoInterface{".PHP_EOL;
        else
            $content .= "class ".ucfirst($tableName)."Dao extends SqlDaoInterface{".PHP_EOL;

        $content .= "    private \$conn;".PHP_EOL;
        $content .= "    private \$tableName = \"".$tableName."\";".PHP_EOL;
        
        $content .= "    /**".PHP_EOL;
        $content .= "     * 获取数据库连接,每次进行数据库操作后关闭数据库连接".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    private function getConn(){".PHP_EOL;
        $content .= "        \$MysqlConnect = new MysqlConnect();".PHP_EOL;
        $content .= "        \$this->conn = \$MysqlConnect->getMysqlConnect_Mysqli(\"".$table->getDataBaseName()."\");".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "    /**".PHP_EOL;
        $content .= "     * 全字段查询,返回一个数组".PHP_EOL;
        $content .= "     * 数组里有对象信息的键值对格式信息".PHP_EOL;
        $content .= "     * @return \$data不为0时返回存储对应类型po对象的数组,否则返回0 ".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function select(){".PHP_EOL;
        $content .= "        \$this->getConn();".PHP_EOL;
        $content .= "        \$data = array();".PHP_EOL;
        $content .= "        \$sql = \"SELECT * FROM \$this->tableName\";".PHP_EOL;
        $content .= "        \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= $this->selectContent($table, $nameRule, 1);
        $content .= "        mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "        return count(\$data)!=0?\$data:0;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        if($primaryKeyCount > 0){
            $content .= "    /**".PHP_EOL;
            $content .= "     * 根据id查询".PHP_EOL;
            $content .= "     * 如果有信息返回对象,否则返回null".PHP_EOL;
            $content .= "     * @param 当表主键只有一个时参数为\$PK 可直接输入主键参数 ".PHP_EOL;
            $content .= "     * @param 当表主键有多个时参数为\$POJO 一个对应的po对象,创建对象时需设置对应主键参数 ".PHP_EOL;
            $content .= "     * @return 返回一个对应的po对象 ".PHP_EOL;
            $content .= "     */".PHP_EOL;
            if($primaryKeyCount == 1){
                $content .= "    public function selectByPK(\$PK){".PHP_EOL;
            }else if($primaryKeyCount > 1){
                $content .= "    public function selectByPK(\$POJO){".PHP_EOL;
            }
            $content .= "        \$this->getConn();".PHP_EOL;
            $content .= "        \$id = \"\";".PHP_EOL;
            if($primaryKeyCount == 1){
                $content .= "        \$id = \"".$primaryKeyArray[0]." = '\$PK'"."\";".PHP_EOL;
            }else if($primaryKeyCount > 1){
                if($nameRule)
                    $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
                else
                    $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
                for($i = 0; $i < $primaryKeyCount; $i++){
                    if($nameRule){
                        $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }else{
                        $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }
                }
                $content .= "            \$id = rtrim(\$id,' AND ');".PHP_EOL;
                $content .= "        }".PHP_EOL;
            }
            $content .= "        \$sql = \"SELECT * FROM \$this->tableName WHERE \$id\";".PHP_EOL;
            $content .= "        \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
            if($nameRule)
                $content .= "        \$".$this->camelCaseConvert($tableName, 0)." = null;".PHP_EOL;
            else
                $content .= "        \$".$tableName." = null;".PHP_EOL;
            $content .= $this->selectContent($table, $nameRule, 0);
            $content .= "        mysqli_close(\$this->conn);".PHP_EOL;
            if($nameRule)
                $content .= "        return \$".$this->camelCaseConvert($tableName, 0)."!=null?\$".$this->camelCaseConvert($tableName, 0).":null;".PHP_EOL;
            else
                $content .= "        return \$".$tableName."!=null?\$".$tableName.":null;".PHP_EOL;
            $content .= "    }".PHP_EOL;
        }else{
            $content .= "    /**".PHP_EOL;
            $content .= "     * 没有主键的表".PHP_EOL;
            $content .= "     */".PHP_EOL;
            $content .= "    public function selectByPK(\$PK){".PHP_EOL;
            $content .= "    }".PHP_EOL;

        }

        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据选择字段查询".PHP_EOL;
        $content .= "     * @param \$POJOExample 设置对应表多个条件的参数对象".PHP_EOL;
        $content .= "     * @return \$data不为0时返回存储对应类型po对象的数组,否则返回0".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function selectByExample(\$POJOExample){".PHP_EOL;
        if($nameRule)
            $content .= "        if(\$POJOExample instanceof ".$this->camelCaseConvert($tableName, 1)."Example){".PHP_EOL;
        else
            $content .= "        if(\$POJOExample instanceof ".ucfirst($tableName)."Example){".PHP_EOL;
        $content .= "            \$this->getConn();".PHP_EOL;
        $content .= "            \$values = \"\";".PHP_EOL;
        $content .= "            if(\$POJOExample->getCondition() != \"\"){".PHP_EOL;
        $content .= "                \$values .= \" WHERE \".\$POJOExample->getCondition();".PHP_EOL;
        $content .= "            }".PHP_EOL;
        $content .= "            if(\$POJOExample->getKind() != \"\"){".PHP_EOL;
        $content .= "                \$values .= \" \".\$POJOExample->getKind();".PHP_EOL;
        $content .= "            }".PHP_EOL;
        $content .= "            \$data = array();".PHP_EOL;
        $content .= "            \$sql = \"SELECT * FROM \".\$this->tableName.\$values;".PHP_EOL;
        $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= $this->selectContent($table, $nameRule, 1);
        $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "            return count(\$data)!=0?\$data:0;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return false;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "    /**".PHP_EOL;
        $content .= "     * 全字段插入".PHP_EOL;
        $content .= "     * 插入前还得用instanceof 检测参数是否为对应的实现类".PHP_EOL;
        $content .= "     * @param \$POJO 需把对象所有变量都设置".PHP_EOL;
        $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function insert(\$POJO){".PHP_EOL;
        if($nameRule)
            $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
        else
            $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
        $content .= "            \$this->getConn();".PHP_EOL;
        $content .= "            \$keys = \"\";".PHP_EOL;
        $content .= "            \$values = \"\";".PHP_EOL;
        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$primaryKeyArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$primaryKeyArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$fieldNameArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$fieldNameArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        $content .= "            \$sql = \"INSERT INTO \".\$this->tableName.\" (\".rtrim(\$keys, ',').\")\".\" VALUES\".\"(\".rtrim(\$values, ',').\")\";".PHP_EOL;
        $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= "            if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
        $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "            return \$result;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return false;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "    /**".PHP_EOL;
        $content .= "     * 选择字段插入,数据库有的字段不是必填的".PHP_EOL;
        $content .= "     * 可以null".PHP_EOL;
        $content .= "     * @param \$POJO 需把对象任意变量设置".PHP_EOL;
        $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function insertByExample(\$POJO){".PHP_EOL;
        if($nameRule)
            $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
        else
            $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
        $content .= "            \$this->getConn();".PHP_EOL;
        $content .= "            \$keys = \"\";".PHP_EOL;
        $content .= "            \$values = \"\";".PHP_EOL;
        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$primaryKeyArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$primaryKeyArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$fieldNameArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$keys .= \"".$fieldNameArray[$i].",\";".PHP_EOL;
                    $content .= "                \$values .= \"'\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        $content .= "            \$sql = \"INSERT INTO \".\$this->tableName.\" (\".rtrim(\$keys, ',').\")\".\" VALUES\".\"(\".rtrim(\$values, ',').\")\";".PHP_EOL;
        $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= "            if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
        $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "            return \$result;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return false;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        if($primaryKeyCount > 0){
            $content .= "    /**".PHP_EOL;
            $content .= "     *  根据主键选择字段修改".PHP_EOL;
            $content .= "     * @param \$POJO 需把主键变量都设置好,并设置好想要修改的字段".PHP_EOL;
            $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
            $content .= "     */".PHP_EOL;
            $content .= "    public function updateByPK(\$POJO){".PHP_EOL;
            if($nameRule)
                $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
            else
                $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
            $content .= "            \$this->getConn();".PHP_EOL;
            $content .= "            \$id = \"\";".PHP_EOL;
            if($primaryKeyCount == 1){
                $content .= "            \$id = \"".$primaryKeyArray[0]." = '\".\$POJO->get".$this->camelCaseConvert($primaryKeyArray[0], 1)."().\"'\";".PHP_EOL;
            }else if($primaryKeyCount > 1){
                for($i = 0; $i < $primaryKeyCount; $i++){
                    if($nameRule){
                        $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }else{
                        $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }
                }
                $content .= "            \$id = rtrim(\$id,' AND ');".PHP_EOL;
            }
            $content .= "            \$values = \"\";".PHP_EOL;
            if($primaryKeyCount > 0){
                for($i = 0; $i < $primaryKeyCount; $i++){
                    if($nameRule){
                        $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                        $content .= "                \$values .= \"".$primaryKeyArray[$i]."='\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                        $content .= "            }".PHP_EOL;
                    }else{
                        $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                        $content .= "                \$values .= \"".$primaryKeyArray[$i]."='\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                        $content .= "            }".PHP_EOL;
                    }
                }
            }
            if($fieldNameCount > 0){
                for($i = 0; $i < $fieldNameCount; $i++){
                    if($nameRule){
                        $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                        $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                        $content .= "                \$values .= \"".$fieldNameArray[$i]."='\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                        $content .= "            }".PHP_EOL;
                    }else{
                        $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                        $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                        $content .= "                \$values .= \"".$fieldNameArray[$i]."='\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                        $content .= "            }".PHP_EOL;
                    }
                }
            }
            $content .= "            \$sql = \"UPDATE \".\$this->tableName.\" SET \".rtrim(\$values,', ').\" WHERE \$id\";".PHP_EOL;
            $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
            $content .= "            if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
            $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
            $content .= "            return \$result;".PHP_EOL;
            $content .= "        }".PHP_EOL;
            $content .= "        return false;".PHP_EOL;
            $content .= "    }".PHP_EOL;
        }else{
            $content .= "    /**".PHP_EOL;
            $content .= "     *  没有主键".PHP_EOL;
            $content .= "     */".PHP_EOL;
            $content .= "    public function updateByPK(\$POJO){".PHP_EOL;
            $content .= "    }".PHP_EOL;
        }

        $content .= "    /**".PHP_EOL;
        $content .= "     * 基于复合条件选择字段修改".PHP_EOL;
        $content .= "     * @param \$POJO 设置好想要修改的字段".PHP_EOL;
        $content .= "     * @param \$POJOExample WHERE的AND OR LIKE条件".PHP_EOL;
        $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function updateByExample(\$POJO, \$POJOExample){".PHP_EOL;
        if($nameRule)
            $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
        else
            $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
        $content .= "            \$this->getConn();".PHP_EOL;
        $content .= "            \$id = \"\";".PHP_EOL;
        if($nameRule)
            $content .= "            if(\$POJOExample instanceof ".$this->camelCaseConvert($tableName, 1)."Example){".PHP_EOL;
        else
            $content .= "            if(\$POJOExample instanceof ".ucfirst($tableName)."Example){".PHP_EOL;
        $content .= "                if(\$POJOExample->getCondition() != \"\"){".PHP_EOL;
        $content .= "                    \$id .= \" WHERE \".\$POJOExample->getCondition();".PHP_EOL;
        $content .= "                }".PHP_EOL;
        $content .= "            }".PHP_EOL;

        $content .= "            \$values = \"\";".PHP_EOL;
        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$primaryKeyArray[$i]."='\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "            if(\$POJO->get".$primaryKeyFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$primaryKeyArray[$i]."='\".\$POJO->get".$primaryKeyFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$fieldNameArray[$i]."='\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "            if(\$POJO->get".$fieldNameFirstCapital ."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$fieldNameArray[$i]."='\".\$POJO->get".$fieldNameFirstCapital."().\"',\";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        $content .= "            \$sql = \"UPDATE \".\$this->tableName.\" SET \".rtrim(\$values,', ').\"\$id\";".PHP_EOL;
        $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= "            if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
        $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "            return \$result;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return false;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        if($primaryKeyCount > 0){
            $content .= "    /**".PHP_EOL;
            $content .= "     * 根据主键删除".PHP_EOL;
            $content .= "     * @param 当表主键只有一个时参数为\$PK 可直接输入主键参数 ".PHP_EOL;
            $content .= "     * @param 当表主键有多个时参数为\$POJO 一个对应的po对象,创建对象时需设置对应主键参数 ".PHP_EOL;
            $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
            $content .= "     */".PHP_EOL;
            if($primaryKeyCount == 1){
                $content .= "    public function deleteByPK(\$PK){".PHP_EOL;
            }else if($primaryKeyCount > 1){
                $content .= "    public function deleteByPK(\$POJO){".PHP_EOL;
            }
            $content .= "        \$this->getConn();".PHP_EOL;
            $content .= "        \$id = \"\";".PHP_EOL;
            if($primaryKeyCount == 1){
                $content .= "        \$id =\"".$primaryKeyArray[0]." = '\$PK'"."\";".PHP_EOL;
            }else if($primaryKeyCount > 1){
                if($nameRule)
                    $content .= "        if(\$POJO instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
                else
                    $content .= "        if(\$POJO instanceof ".ucfirst($tableName)."){".PHP_EOL;
                for($i = 0; $i < $primaryKeyCount; $i++){
                    if($nameRule){
                        $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }else{
                        $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                        $content .= "            if(\$POJO->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                        $content .= "                \$id .= \"".$primaryKeyArray[$i]." = '\".\$POJO->get".$primaryKeyFirstCapital."().\"' AND \";".PHP_EOL;    
                        $content .= "            }".PHP_EOL;
                    }
                }
                $content .= "            \$id = rtrim(\$id,' AND ');".PHP_EOL;
                $content .= "        }".PHP_EOL;
            }
            $content .= "        \$sql = \"DELETE FROM \".\$this->tableName.\" WHERE \$id\";".PHP_EOL;
            $content .= "        \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
            $content .= "        if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
            $content .= "        mysqli_close(\$this->conn);".PHP_EOL;
            $content .= "        return \$result;".PHP_EOL;
            $content .= "    }".PHP_EOL;
        }else{
            $content .= "    /**".PHP_EOL;
            $content .= "     * 没有主键".PHP_EOL;
            $content .= "     */".PHP_EOL;
            $content .= "    public function deleteByPK(\$PK){".PHP_EOL;
            $content .= "    }".PHP_EOL;
        }
        
        $content .= "    /**".PHP_EOL;
        $content .= "     * 根据选择字段删除".PHP_EOL;
        $content .= "     * @param \$POJOExample 设置对应表多个条件的参数对象".PHP_EOL;
        $content .= "     * @return 根据SQL操作返回TRUE或者FALSE".PHP_EOL;
        $content .= "     */".PHP_EOL;
        $content .= "    public function deleteByExample(\$POJOExample){".PHP_EOL;
        if($nameRule)
            $content .= "        if(\$POJOExample instanceof ".$this->camelCaseConvert($tableName, 1)."Example){".PHP_EOL;
        else
            $content .= "        if(\$POJOExample instanceof ".ucfirst($tableName)."Example){".PHP_EOL;
        $content .= "            \$this->getConn();".PHP_EOL;
        $content .= "            \$id = \"\";".PHP_EOL;
        $content .= "            if(\$POJOExample->getCondition() != \"\"){".PHP_EOL;
        $content .= "                \$id .= \" WHERE \".\$POJOExample->getCondition();".PHP_EOL;
        $content .= "            }".PHP_EOL;
        $content .= "            \$sql = \"DELETE FROM \".\$this->tableName.\"\$id\";".PHP_EOL;
        $content .= "            \$result = mysqli_query(\$this->conn, \$sql);".PHP_EOL;
        $content .= "            if(\$result == false) die (\"Mysql Error: \" . \$this->conn->error);".PHP_EOL;
        $content .= "            mysqli_close(\$this->conn);".PHP_EOL;
        $content .= "            return \$result;".PHP_EOL;
        $content .= "        }".PHP_EOL;
        $content .= "        return false;".PHP_EOL;
        $content .= "    }".PHP_EOL;

        $content .= "}".PHP_EOL;
        $content .= "?>".PHP_EOL;
        return $content;
    }

    private function ConditionContent($table, $nameRule){
        $tableName = $table->getTableName();
        $primaryKeyArray = $table->getPrimaryKeyArray();
        $primaryKeyCount = count($primaryKeyArray);
        $fieldNameArray = $table->getFieldNameArray();
        $fieldNameCount = count($fieldNameArray);
        $content = "";
        if($nameRule)
            $content .= "        if(\$".$this->camelCaseConvert($tableName, 0)." instanceof ".$this->camelCaseConvert($tableName, 1)."){".PHP_EOL;
        else
            $content .= "        if(\$".$tableName." instanceof ".ucfirst($tableName)."){".PHP_EOL;
        $content .= "            \$values = \"\";".PHP_EOL;
        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "            if(\$".$this->camelCaseConvert($tableName, 0)."->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$primaryKeyArray[$i]." \$operate '\".\$".$this->camelCaseConvert($tableName, 0)."->get".$primaryKeyFirstCapital."().\"' \$Lword \";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "            if(\$".$this->camelCaseConvert($tableName, 0)."->get".$primaryKeyFirstCapital."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$primaryKeyArray[$i]." \$operate '\".\$".$tableName."->get".$primaryKeyFirstCapital."().\"' \$Lword \";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "            if(\$".$this->camelCaseConvert($tableName, 0)."->get".$fieldNameFirstCapital."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$fieldNameArray[$i]." \$operate '\".\$".$this->camelCaseConvert($tableName, 0)."->get".$fieldNameFirstCapital."().\"' \$Lword \";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }else{
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "            if(\$".$this->camelCaseConvert($tableName, 0)."->get".$fieldNameFirstCapital."() != null){".PHP_EOL;
                    $content .= "                \$values .= \"".$fieldNameArray[$i]." \$operate '\".\$".$tableName."->get".$fieldNameFirstCapital."().\"' \$Lword \";".PHP_EOL;
                    $content .= "            }".PHP_EOL;
                }
            }
        }
        $content .= "        }".PHP_EOL;
        $content .= "        \$this->condition = rtrim(\$values,\" \$Lword \");".PHP_EOL;
        return $content;
    }

    private function selectContent($table, $nameRule, $flag){
        $tableName = $table->getTableName();
        $primaryKeyArray = $table->getPrimaryKeyArray();
        $primaryKeyCount = count($primaryKeyArray);
        $fieldNameArray = $table->getFieldNameArray();
        $fieldNameCount = count($fieldNameArray);
        $content = "";
        $content .= "        while(\$row=\$result->fetch_array()){".PHP_EOL;
        if($nameRule)
            $content .= "            \$".$this->camelCaseConvert($tableName, 0)." = new ".$this->camelCaseConvert($tableName, 1)."();".PHP_EOL;
        else
            $content .= "            \$".$tableName." = new ".ucfirst($tableName)."();".PHP_EOL;

        if($primaryKeyCount > 0){
            for($i = 0; $i < $primaryKeyCount; $i++){
                if($nameRule){
                    $primaryKeyFirstCapital = $this->camelCaseConvert($primaryKeyArray[$i], 1);
                    $content .= "            \$".$this->camelCaseConvert($tableName, 0)."->set".$primaryKeyFirstCapital."(\$row[\"".$primaryKeyArray[$i]."\"]);".PHP_EOL;
                }else{
                    $primaryKeyFirstCapital = ucfirst($primaryKeyArray[$i]);
                    $content .= "            \$".$tableName."->set".$primaryKeyFirstCapital."(\$row[\"".$primaryKeyArray[$i]."\"]);".PHP_EOL;
                }
            }
        }
        if($fieldNameCount > 0){
            for($i = 0; $i < $fieldNameCount; $i++){
                if($nameRule){
                    $fieldNameFirstCapital = $this->camelCaseConvert($fieldNameArray[$i], 1);
                    $content .= "            \$".$this->camelCaseConvert($tableName, 0)."->set".$fieldNameFirstCapital."(\$row[\"".$fieldNameArray[$i]."\"]);".PHP_EOL;
                }else{
                    $fieldNameFirstCapital = ucfirst($fieldNameArray[$i]);
                    $content .= "            \$".$tableName."->set".$fieldNameFirstCapital."(\$row[\"".$fieldNameArray[$i]."\"]);".PHP_EOL;
                }
            }
        }
        if($flag){
            if($nameRule)
                $content .= "            \$data[] = \$".$this->camelCaseConvert($tableName, 0).";".PHP_EOL;
            else
                $content .= "            \$data[] = \$".$tableName.";".PHP_EOL;
        }
        $content .= "        }".PHP_EOL;
        return $content;
    }

    public function camelCaseConvert($name, $flag){
        $newName = "";
        $pattern = "/[\s,\/_\.\-;$\\\\]+/";
        if($flag) $name = ucfirst($name);
        for($i = 0; $i < strlen($name); $i++){
            if(preg_match($pattern, $name[$i]) > 0 && preg_match("/^[A-Za-z]+$/", $name[$i+1]) > 0 && isset($name[$i+1])){
                $name[$i+1] = strtoupper($name[$i+1]);
            }
        }
        $newName = preg_replace($pattern, "", $name);
        return $newName;
    }
}
?>