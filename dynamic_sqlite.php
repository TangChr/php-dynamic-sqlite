<?php

/**
 * @author Christian Tang
 */

class SQLite
{
    private $db;
    private $dbname;
    
    
    public function __construct($dbname)
    {
        $this->dbname = $dbname;
    }
    
    public function initDb()
    {
        try
        {
            $this->db = new PDO('sqlite:'.$this->dbname);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
    
    function createTable($table)
    {
        $strTable = 'CREATE TABLE IF NOT EXISTS '.$table->name.' (';
        $strFields;
        foreach($table->fields as $f) {
            if($strFields != '')
            $strFields .= ',';
            $strFields .= $f->name.' '.$f->type;
        }
        $strFields .= ')';
        $strTable .= $strFields;
                
        $this->db->exec($strTable);
    }
    
    function insert($table, $array)
    {
        try 
        {
            $strColumns = implode(',', array_keys($array));
            $strValues = implode(',', array_fill(0, count($array), '?'));

            $stmt = $this->db->prepare("INSERT INTO $table ({$strColumns}) VALUES ({$strValues})");
            return $stmt->execute(array_values($array));
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
}

class SQliteTable
{
    var $name;
    var $fields;
    
    public function __construct($tableName) {
        $this->name = $tableName;
    }
    
    public function addField($fieldName, $fieldType) {
        $tmp = new SQliteField($fieldName, $fieldType);
        $this->fields[] = $tmp;
    }
}

class SQliteField
{
    var $name;
    var $type;
    
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }
}
?>