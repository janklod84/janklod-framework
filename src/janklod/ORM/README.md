$builder = new QueryBuilder();
// SELECT
$builder->select('username', 'password', 'role')
->from('users')
->where('id = :test', ['test' => 3])
->where('NOT password', md5('jean'))
->or('username', 'Michelle')
->orderBy('id', 'DESC')
->orderBy('username')
->limit(1, 5);

// JOIN
$builder->select('username', 'password', 'role')
->from('users')
->join('orders', 'orders.user_id = users.id')
->join('orders', 'orders.user_id = users.id', 'right')
->where('id = :test', ['test' => 3])
->sql();

// INSERT
$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
$builder->insert('users', $posts)->sql();
$builder->insert('users')
->set($posts)
->sql();


// UPDATE
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
$builder = new QueryBuilder();
 
$builder->count('username', 'users', 'Customers')
       ->sql();

$builder->avg('username', 'users', 'Customers');

 $builder->max('username', 'users', 'Customers')
           ->sql();

 $builder->min('username', 'users', 'Customers')
           ->sql();



// SHOW COLUMNS 
 $builder->showColumn('users')
           ->sql();

// TRUNCATE
$builder->truncate('users')
           ->sql();



// 
$builder = new QueryBuilder();
     
$posts = ['username' => 'Jean', 'password' => md5('test'), 'role' => 3];
echo $builder->insert('users', $posts)->sql();
debug($builder->values);

$posts = ['username' => 'Jean2', 'password' => md5('test2'), 'role' => 1];
echo $builder->insert('users')
->set($posts)
->sql();
debug($builder->values);