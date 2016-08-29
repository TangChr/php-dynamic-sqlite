# PHP Dynamic SQLite
[![License](https://img.shields.io/github/license/TangChr/php-dynamic-sqlite.svg)](https://raw.githubusercontent.com/TangChr/php-dynamic-sqlite/master/LICENSE)

PHP-library for working with SQLite databases.


**Current features**
- Connect to SQLite database
- Create SQLite database
- Create tables
- Insert values using arrays

### Examples
```php
<?php
/*
Example: Create table
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
?>
```

```php
<?php
/*
Example: Insert row
*/
require 'dynamic_sqlite.php';
$db    = 'messages.db';
$table = 'message';

$sqlite = new SQLite($db);
$sqlite->initDb();

$message = array('title'=>'My Title', 'text'=>'My Message');

if($sqlite->insert($table, $message))
    echo 'Success!';
?>
```
