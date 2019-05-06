<?php 

/*
$db = \JK\Database\DatabaseManager::instance();
$stmt = $db->query('SELECT * FROM posts');
debug($stmt);

$query = new \JK\Database\ORM\Query();
$rs = $query->execute('SELECT * FROM posts')->results();
debug($rs);
*/

$qb = new \JK\Database\ORM\QueryBuilder();

$qb->select()->from('posts')
             ->where('id', 3)
             ->sql();
