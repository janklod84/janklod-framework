<?php 
/*
	UPDATE user SET password=PASSWORD("your_password") WHERE user="root";
    FLUSH PRIVILEGES;
    EXITs
*/

/*
use JK\Database\DatabaseManager;
use JK\Database\Statement\Query;


function insert($params)
{
	$db = DatabaseManager::instance();
    // $query = new Query($db);
	// $sql = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';
	$sql = 'INSERT INTO users SET username = ?, password = ?, role = ?';

	

	try 
	{
		 $stmt = $db->prepare($sql);
	     $stmt->execute($params);

	}catch(PDOException $e){
          die('Error: ' . $e->getMessage());
	}
}

insert(['Brown1',  'wwdft3', '1']);
*/

/*
use JK\Database\DatabaseManager;
$db = DatabaseManager::instance();


$dsn = 'mysql:host=localhost;port=3306;dbname=dbproject;charset=utf8';
$user = 'root';
$pass = 'root';
$options = [
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_PERSISTENT => false
];

// $pdo = new PDO($dsn, $user, $pass, $options);

$stmt = $db->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
$stmt->execute([
  'Test3',
  'testinstance',
  '2'
]);
*/
