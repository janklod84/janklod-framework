<?php 
use JK\Database\DatabaseManager;
use JK\Database\Statement\Query;


$db = DatabaseManager::instance();
$query = new Query($db);
/*
// $query->fetchStyle(PDO::FETCH_CLASS, 'app\\models\\Entity\\User');
SELECT
$execute = $query->execute('SELECT * FROM users');
debug($execute->results()); 

SELECT WHERE
$execute = $query->execute('SELECT * FROM users WHERE id = ?', [2]);
debug($execute->results()); 

INSERT
// $insert = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';
$insert = 'INSERT INTO posts (name, slug, content, created_at) VALUES (:name, :slug, :content, :created_at)';
$query->execute($insert, [
  'name' => 'post1',  
  'slug' => 'post-1',   
  'content' => 'juste du contenu',  
  'created_at' => date('Y-m-d H:i:s')
], false);
$insert = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';
$query->execute($insert, ['Brown1',  'wwdft3',  '1']);
*/
$sql = 'INSERT INTO users (username, password, role) VALUES (?, ?, ?)';
$query->execute($sql, ['Brown1',  'wwdft3',  '1']);



/*
$qb = new \JK\Database\ORM\QueryBuilder();

$sql = $qb->select('id', 'name', 'username')
          ->from('users', 'u')
          ->join('orders', 'users.id = orders.user_id')
          ->join('products', 'orders.product_id = products.id')
          ->where('name', 'Kouassi')
          ->where('username', 'Yao')
          ->orderBy('status')
          ->limit(1)
          ->sql();


echo $sql;

debug($qb->values);

$sql2 = $qb->update('users')
           ->set(['username' => 'new-name', 'password' => 'Qwerty'])
           ->where('id', 4)
           ->sql();

echo $sql2;
debug($qb->values);
*/

