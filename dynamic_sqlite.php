<?php

/**
 * @author Christian Tang
 */

function sqlite_insert($db, $table, $array)
{
    try 
    {
        $file_db = new PDO('sqlite:'.$db);
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        foreach($array as $k => $v)
        {
            $colums .= $k.',';
            $values .= ':'.$k.',';
        }
        $insert = 'INSERT INTO '.$table.' ('.rtrim($colums, ',').') VALUES('.rtrim($values, ',').')';
        
        $stmt = $file_db->prepare($insert);
        foreach($array as $k => $v)
            $stmt->bindValue(':'.$k, $v);
            
        return $stmt->execute();
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
}
?>