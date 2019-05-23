$builder = new QueryBuilder();
// SELECT
======================================================
$builder->select('username', 'password', 'role')
->from('users')
->where('id = :test', ['test' => 3])
->where('NOT password', md5('jean'))
->or('username', 'Michelle')
->orderBy('id', 'DESC')
->orderBy('username')
->limit(1, 5);
 

 // ALIAS
 ====================================================
 echo $builder->select('id', 'test')
        ->from('users', 'u')
        ->where('id = :id', ['id' => 3])
        ->orderBy('username', 'desc')
        ->orderBy('login', 'asc');

 debug($builder->values);
// WHERE
===================================================
echo $builder->select('id', 'test')
            ->from('users', 'u')
            ->where('id = :id', ['id' => 3]);


// JOIN
===================================================
$builder->select('username', 'password', 'role')
->from('users')
->join('orders', 'orders.user_id = users.id')
->join('orders', 'orders.user_id = users.id', 'right')
->where('id = :test', ['test' => 3])
->sql();

// INSERT
===================================================
$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
$builder->insert('users', $posts)->sql();
$builder->insert('users')
->set($posts)
->sql();


// UPDATE
===================================================
$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
$builder->update('users', $posts)
->sql();
$builder->update('users')
->set($posts)
->sql();

$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
$builder->update('users', $posts)
->sql();


// COUNT, AVG , SUM ...
===================================================
$builder = new QueryBuilder();
 
$builder->count('username', 'users', 'Customers')
       ->sql();

$builder->avg('username', 'users', 'Customers');

 $builder->max('username', 'users', 'Customers')
           ->sql();

 $builder->min('username', 'users', 'Customers')
           ->sql();



// SHOW COLUMNS
=================================================== 
 $builder->showColumn('users')
           ->sql();

// TRUNCATE
===================================================
$builder->truncate('users')
           ->sql();



// INSERT
========================================================
$builder = new QueryBuilder();
     
$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
echo $builder->insert('users', $posts)->sql();
debug($builder->values);

$posts = ['username' => 'Jean2', 'password' => md5('test2'), 'role' => 1];
echo $builder->insert('users')
->set($posts)
->sql();
debug($builder->values);

WHERE 
============================================================
$builder = new QueryBuilder();
     
echo $builder->select('id', 'test')
            ->from('users', 'u')
            ->where('id = :id', ['id' => 3])
            ->orderBy('username', 'desc')
            ->orderBy('login', 'asc');


debug($builder->values);

// TEST Query
==========================================================
$query = new \JK\ORM\Query(
  \JK\Database\DatabaseManager::instance(),  
  'users'
);


// $fields = ['username' => 'jean','password' => sha1('qwerty'),'role' => 2];
// $query->create($fields);

// $fields = ['username' => 'jean', 'password' => 'ssss', 'role' => 1];
// for($i = 1; $i < 5; $i++)
// {
//    // $query->create($fields);
// }

$data = ['username' => 'Brown1'];
$query->update($data, 1);

debug($query->builder());
/*
 // set fetch mode 
 $query->fetchClass('app\\models\\User'); 
*/
$query->fetchClass('app\\models\\User'); 

/*
 // READ
 $query->read(3);
*/

$query->delete(3);

echo $query->builder()
           ->select('username', 'password', 'role', 'dddd', 'xxx')
           ->where('id = ?', 5)
           ->orderBy('something')
           ->limit('2,3');



// TEST 2
=====================================================
$db = \JK\Database\DatabaseManager::instance();

$query = new \JK\ORM\Query();
$query->connect($db)
->table('users')
->all();


// $fields = ['username' => 'jean','password' => sha1('qwerty'),'role' => 2];
// $query->create($fields);

// $fields = ['username' => 'jean', 'password' => 'ssss', 'role' => 1];
// for($i = 1; $i < 5; $i++)
// {
//    // $query->create($fields);
// }

$data = ['username' => 'Brown1'];
$query->update($data, 1);

/*
// set fetch mode 
$query->fetchClass('app\\models\\User'); 
*/
$query->fetchClass('app\\models\\User'); 

/*
// READ
$query->read(3);
*/

$query->delete(3);

echo $query->builder()
 ->select('username', 'password', 'role', 'dddd', 'xxx')
 ->from('users')
 ->where('id = ?', 5)
 ->orderBy('something')
 ->limit('2,3');


TEST 3
==================================================
 // $query = new \JK\ORM\Query(
   //    \JK\Database\DatabaseManager::instance(),  
   //    'users'
   // );

    $db = \JK\Database\DatabaseManager::instance();

    $query = new \JK\ORM\Query();
    $results = $query->connect($db)
                     ->fetchClass('app\\models\\User')
                     ->table('users')
                     ->read(2);
    
    debug($results);

   $data = ['username' => 'Brown1'];
   // $query->update($data, 1);

   /*
     // set fetch mode 
     $query->fetchClass('app\\models\\User'); 
   */
    
