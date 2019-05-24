
// Instance of connection
$db = DatabaseManager::instance();

// Your connection
$db = new PDO('your dsn', 'your username', 'your password', 'password');

// Add simple connection [connection must to be instance to PDO]
QQ::setup($db);

// Add table name
// QQ::addTable('users');

// Map table
// echo QQ::map('table');

// Get Table or Map
// echo QQ::getTable();

// Add connection with table name
// QQ::setup($db, 'users');


=========================================================================
// Add simple connection [connection must to be instance to PDO]
QQ::setup($db);

// Create record
QQ::table('users')->create([
 'username' => 'TestQQ',  
 'password' => md5('newQQ'),  
 'role' => 5
]);

=============================================================================
FETCH DATA

// Instance of connection
$db = DatabaseManager::instance();

// Add simple connection [connection must to be instance to PDO]
QQ::setup($db, 'users');

// Create record 
/*
OK TEST
QQ::getTable()->create([
'username' => 'TestQQ',  
'password' => md5('newQQ'),  
'role' => 7
]);
*/

/* $result = QQ::getTable()->read(2); debug($result); OK TEST */

QQ::fetchClass('app\\models\\User\\User');
// QQ::query()->fetchClass('app\\models\\User\\User');
// $results = QQ::getTable()->all();
// debug($results);

$result = QQ::getTable()->read(2); debug($result);

==========================================================================
Execute Own Query

// Instance of connection
$db = DatabaseManager::instance();

// Add simple connection [connection must to be instance to PDO]
QQ::setup($db, 'users');

// $result = QQ::execute('SELECT * FROM users WHERE id = ?', [2])
// ->first();

$result = QQ::execute('SELECT * FROM users WHERE id = :id', ['id' => 3])
->first();

debug($result);

==========================================================================
CREATE
// Instance of connection
$db = DatabaseManager::instance();

// Add simple connection [connection must to be instance to PDO]
QQ::setup($db, 'users');

// debug(QQ::getTable(true)); // return name of table

// Create record
QQ::getTable()->create([
 'username' => 'TestQQ',  
 'password' => md5('newQQ'),  
 'role' => 7
]);


=============================================================================

// UPDATE
// Instance of connection
   $db = DatabaseManager::instance();

   // Add simple connection [connection must to be instance to PDO]
   QQ::setup($db, 'users');

   QQ::getTable()->update([
     'username' => 'UpdatedQQ3', 
     'role' => 3
   ], 3);
 

   QQ::table('users')->create([
     'username' => 'New', 
     'password' => md5('qwwe'), 
     'role' => 9
   ]);
   
   

   // $result = QQ::execute('SELECT * FROM users WHERE id = ?', [2])
   // ->first();
   
   $result = QQ::execute('SELECT * FROM users WHERE id = :id', ['id' => 3])
   ->first();

   debug($result);
=============================================================================

DELETE

// Instance of connection
$db = DatabaseManager::instance();

// Add simple connection [connection must to be instance to PDO]
QQ::setup($db, 'users');


QQ::getTable()->delete(5);

