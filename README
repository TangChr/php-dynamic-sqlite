PHP Dynamic SQLite
==============
PHP-library for working with SQLite databases.


Current features
--------------
- Connect to SQLite database
- Create SQLite database
- Create tables
- Insert values into a table using an array

Example
--------------
  <?php
  
  /**
   * @author Christian Tang
   */
  require 'dynamic_sqlite.php';
  
  $db = 'messages.db';
  $table = new SQliteTable('message');
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
