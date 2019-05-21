<?php 
namespace JK\ORM;


/**
 * @package JK\ORM\QueryBuilder 
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


const NBQuery = '\\JK\\ORM\\Builder\\%sBuilder';




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
 * COUNT of column
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function count($column, $table, $alias = null)
{
      return $this->arithmeticQuery($column, $table, 'COUNT', $alias);
}


/**
 * AVG of column
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function avg($column, $table, $alias = null)
{
      return $this->arithmeticQuery($column, $table, 'AVG', $alias);
}


/**
 * SUM of column 
 * @param string $column 
 * @param string $table 
 * @param string $alias
 * @return QueryBuilder
*/
public function sum($column, $table, $alias = null)
{
      return $this->arithmeticQuery($column, $table, 'SUM', $alias);
}



/**
 * MAX of column 
 * @param string $column 
 * @param string $table
 * @param string $alias 
 * @return QueryBuilder
*/
public function max($column, $table, $alias = null)
{
      return $this->arithmeticQuery($column, $table, 'MAX', $alias);
}



/**
 * MIN of column 
 * @param string $column 
 * @param string $table 
 * @param string $alias 
 * @return QueryBuilder
*/
public function min($column, $table, $alias = null)
{
      return $this->arithmeticQuery($column, $table, 'MIN', $alias);
}


/**
 * Query output
 * @return string
*/
public function sql()
{
    $output = [];
    foreach($this->builders as $builder)
    {
        $output[] = $this->callBuilder($builder);
    }
    return join(' ', $output);
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
 * Artihmetic Query Maker
 * [
 * COUNT(column_name), 
 * AVG(column_name)
 * ]
 * arithmetic('COUNT(username)', 'users')
 * arithmetic('username', 'users', 'COUNT')
 * 
 * @param string $column 
 * @param string $table
 * @param string $type 
 * @return self
*/
protected function arithmeticQuery(
$column='', 
$table = 'no-table', 
$type=null,   
$alias = null
)
{
     if($column !== '')
     {
          $function = $column;
          if(!is_null($type))
          {
               $type = strtoupper($type);
               $function = "$type($column)";
          }

          if($alias)
          {
              $function .= ' AS ' . $alias;
          }

          return $this->select($function)
                      ->from($table);
     }
     return $this;
} 



/**
* Get buider class name
* @param string $builder
* @return string
*/
private function callBuilder($builder)
{
  $builderName = sprintf(self::NBQuery, $builder);

  if(!class_exists($builderName))
  {
  	  die(sprintf('class <strong>%s</strong> does not exist!', $builderName));
  }

  $builderObj = new $builderName($this->sql);
  return call_user_func([$builderObj, 'build']);
}
  
  
/**
* Remove values
* @return void
*/
private function clear()
{
  $this->sql = [];
  $this->values = [];
  $this->builders = [];
}

/*
SELECT * FROM `users` WHERE id = ? INSERT INTO `users` (`username`, `password`, `role`) VALUES (?, ?, ?)
*/


}