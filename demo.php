<?php

/**
 * @author Christian Tang
 */
require 'dynamic_sqlite.php';

$db = 'messages.db';
$table = 'message';
$message = array('title'=>'My Title', 'content'=>'My Message');
// execute function
if(insert_sqlite($db, $table, $message))
    echo 'Success!';
?>