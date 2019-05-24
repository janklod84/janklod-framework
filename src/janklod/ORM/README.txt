
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


