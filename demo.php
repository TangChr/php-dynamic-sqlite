<?php

/**
 * @author Christian Tang
 */
require 'dynamic_sqlite.php';

$db = 'messages.db';
$table = new SQLiteTable('message');
$table->addField('id', 'INTEGER PRIMARY KEY');
$table->addField('title', 'TEXT');
$table->addField('text', 'TEXT');

$sqlite = new SQLite($db);
$sqlite->initDb();
$sqlite->createTable($table);

$message = array('title'=>'My Title', 'text'=>'My Message');

if($sqlite->insert($table->name, $message))
    echo 'Success!';
?>
