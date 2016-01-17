<?php

/**
 * @author Christian Tang
 */

class SQLite
{
    private $database;
    private $databaseName;
    
    
    public function __construct($databaseName)
    {
        $this->databaseName = $databaseName;
    }
    
    public function initdatabase()
    {
        try
        {
            $this->database = new PDO('sqlite:'.$this->databaseName);
            $this->database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
    
    function createTable($table)
    {
        $sTable = 'CREATE TABLE IF NOT EXISTS '.$table->name.' (';
        $sFields;
        foreach($table->fields as $f) {
            if($sFields != '')
            $sFields .= ',';
            $sFields .= $f->name.' '.$f->type;
        }
        $sFields .= ')';
        $sTable .= $sFields;
                
        $this->database->exec($sTable);
    }
    
    function insert($table, $array)
    {
        try 
        {
            $sColumns = implode(',', array_keys($array));
            $sValues = implode(',', array_fill(0, count($array), '?'));

            $stmt = $this->database->prepare("INSERT INTO $table ({$sColumns}) VALUES ({$sValues})");
            return $stmt->execute(array_values($array));
        }
        catch(PDOException $e)
        {
            die($e->getMessage());
        }
    }
}

class SQLiteTable
{
    var $name;
    var $fields;
    
    public function __construct($tableName) {
        $this->name = $tableName;
    }
    
    public function addField($fieldName, $fieldType) {
        $field = new SQLiteField($fieldName, $fieldType);
        $this->fields[] = $field;
    }
}

class SQLiteField
{
    var $name;
    var $type;
    
    public function __construct($name, $type) {
        $this->name = $name;
        $this->type = $type;
    }
}
?>