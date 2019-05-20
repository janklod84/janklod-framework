<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	  
/**
 * @var array $builders
 * @var array $sql
 * @var array $values
 * @var array $output
*/
private $builders = [];
private $sql    = [];
public  $values = [];
private $output = [];

const NBQuery = '\\JK\\Database\\ORM\\Builder\\%sBuilder';

const QTYPES = [
	'Select', 
	'Insert', 
	'Update', 
	'Delete'
];



/**
 * Constructor
 * @return void
*/
public function __construct()
{
      // TO Implements
}


/**
 * Select 
 * @param string ...$selects 
 * @return self
*/
public function select(...$selects)
{
   $this->clear();
   $this->sql['select'] = $selects;
   $this->addBuilder('Select');
   return $this;
}


/**
 * From
 * @param string $table 
 * @param string $alias 
 * @return self
*/
public function from($table, $alias='')
{
  $this->sql['table'] = [$table, $alias];
  $this->addBuilder('From');
  return $this;
}




/**
  * Conditions
  * by default $operator is '='
  * and By default AND
  * 
  * Operators [
  * =, >, <, >=, <=, <> or !=,
  * BETWEEN, LIKE, IN
  * ]
  * 
  * where('id', 5)
  * where('login', 'superadmin')
  * where('login', '%test%', 'LIKE')
  * where('orders', 3, '>')
  * where('NOT username', 'Brown')
  * 
  * @param string $column
  * @param string $value
  * @param string $operator
  * @return self
*/
public function where($column='', $value='', $operator = '='): self
{
    $condition = $this->conditionField($column, $value, $operator);
    return $this->conditions($condition, $value);
}


/**
 * Condition OR
 * @param string $column 
 * @param string $value 
 * @param string $operator 
 * @return self
*/
public function or($column = '', $value = '', $operator = '=')
{
    $condition = $this->conditionField($column, $value, $operator);
    return $this->conditions($condition, $value, 'OR');
}



/**
 * Conditions
 * @param string $condition 
 * @param string $type 
 * @return self
*/
public function conditions($condition, $value, $type='AND')
{
     $this->sql['condition'][$type][] = $condition;
     $this->values[] = $value;
     $this->addBuilder('Condition');
     return $this;
}


/**
 * Order Query [Filter]
 * @param string $field
 * @param string $sort 
 * @return $this
*/
public function orderBy($field, $sort='ASC')
{
    if($field)
    {
       $this->sql['orderBy'][] = [$field, $sort];
       $this->addBuilder('OrderBy');
    }
    return $this;
}


/**
* Limit
* @param string $limit
* @param strirng $offset
* @return self
*/
public function limit($limit='', $offset = null)
{
   $this->sql['limit'] = [$limit, $offset];
   $this->addBuilder('Limit');
   return $this;
}


/**
 * Join
 * @param string $join 
 * @param string $condition
 * @param string $type 
 * @return self
*/
public function join($table, $condition, $type='INNER')
{
    $this->sql['join'][$type][] = [$table, $condition];
    $this->addBuilder('Join');
    return $this;
}


 
 /**
  * Set data
  * @param array $data 
  * @return self
 */
 public function set($data=[])
 {
   $this->sql['set'] = array_keys($data);
   $this->values = array_values($data);
   $this->addBuilder('Set');
   return $this;
 }

 
 /**
  * Insert data
  * @param string $table 
  * @param array $params 
  * @return self
 */
 public function insert($table, $params = [])
 {
  $this->clear();
  $this->sql['table'] = $table;
  if($params)
  {
     $this->sql['insert'] = array_keys($params);
     $this->values = array_values($params);
  }
  $this->addBuilder('Insert');
  return $this;
}


/**
* Update data
* @param string $table 
* @param array $params
* @return self
*/
public function update($table, $params = [])
{
  $this->clear();
  $this->sql['table'] = $table;
  if($params) // add functionnality
  {
     $this->sql['update'] = array_keys($params);
     $this->values = array_values($params);
  }
  $this->addBuilder('Update');
  return $this;
}


/**
 * Delete
 * @param string $table 
 * @return self
*/
public function delete($table)
{
    $this->clear();
    $this->sql['table'] = $table;
    $this->addBuilder('Delete');
    return $this;
}



/**
* Truncate table
* @param string $table 
* @return string
*/
public function truncate($table = null)
{
      $this->clear();
      $this->sql['table'] = $table;
      $this->addBuilder('Truncate');
      return $this;
}



/**
 * Show table columns
 * @param string $table 
 * @return string
*/
public function showColumn($table = null)
{
  $this->clear();
  $this->sql['table'] = $table;
  $this->addBuilder('ShowColumn');
  return $this;
}


/**
 * Query output
 * @return string
*/
public function sql()
{
	foreach($this->builders as $builder)
  {
      $this->output[] = $this->callBuilder($builder);
  }
  	
  return join(' ', $this->output);
}


/**
 * stringify 
 * @return string
*/
public function __toString()
{
    return $this->sql();
}
  
  
/**
 * Add class name for building parts
 * @param string $name 
 * @return void
*/
protected function addBuilder(string $name)
{
    if(!in_array($name, $this->builders))
    {
        $this->builders[] = $name;
    }
}


/**
 * Condition fields
 * @param string $column 
 * @param mixed $value 
 * @param string $operator 
 * @return string
*/
protected function conditionField($column, $value, $operator)
{
    return sprintf('%s %s %s', $column, $operator, '?');
}


/**
* Get buider class name
* @param string $builder
* @return string
*/
private function callBuilder($builder)
{
  $class = sprintf(self::NBQuery, $builder);

  if(!class_exists($class))
  {
  	  die(sprintf('Class <strong>%s</strong> does not exist!', $class));
  }

  $classObj = new $class($this->sql);
  return call_user_func([$classObj, 'build']);
}
  
  
/**
* Remove values
* @return void
*/
private function clear()
{
  $this->sql = [];
  $this->values = [];
  $this->output = [];
  $this->builders = [];
}



}