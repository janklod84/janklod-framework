<?php 

/*
use JK\Database\DatabaseManager;
use JK\Database\Statement\Query;
use JK\Database\ORM\QueryBuilder;


function insert($params)
{
	$db = DatabaseManager::instance();
    $query = new Query($db);
    $qb = new QueryBuilder();
	// $sql = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';
	// $sql = 'INSERT INTO users SET username = ?, password = ?, role = ?';
	$sql = $qb->insert('users')
	          ->set($params)
	          ->sql();

	$values = $qb->values;
	return $query->execute($sql, $values, false);
}

insert([
	'username' => 'JBrown3', 
	'password' => 'JQwerty', 
	'role' => '0'
]);
*/
/* insert(['Brown2', 'Qwerty', '2']); */
