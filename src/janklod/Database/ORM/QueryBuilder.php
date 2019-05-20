<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\QueryBuilder 
*/ 
class QueryBuilder 
{
	  
/**
 * @var array $classBuilder
 * @var array $sql
 * @var array $values
 * @var array $output
*/
private $classBuilder = [];
private $sql    = [];
public  $values = [];
private $output = [];

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
   $this->addBuilderClass('Select');
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
  $this->sql['table'] = $table;
  $this->sql['table.alias'] = $alias;
  $this->addBuilderClass('From');
  return $this;
}

  
/**
  * Conditions
  * where('id', 3)
  * by default $operator is '='
  * and By default AND
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
     $this->addBuilderClass('Condition');
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
       $this->addBuilderClass('OrderBy');
    }
    return $this;
}


/**
* Limit
* @param string $limit
* @return self
*/
public function limit($limit='')
{
   $this->sql['limit'] = $limit;
   $this->addBuilderClass('Limit');
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
    // sprintf('%s JOIN %s ', $type, $table);
    $this->sql['join'][$type][] = [$table, $condition];
    $this->addBuilderClass('Join');
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
   $this->addBuilderClass('Set');
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
  $this->sql['insert'] = array_keys($params);
  $this->values = array_values($params);
  $this->addBuilderClass('Insert');
  return $this;
}


/**
* Update data
* @param string $table 
* @param string $alias
* @return self
*/
public function update($table)
{
  $this->clear();
  $this->sql['table'] = $table;
  $this->addBuilderClass('Update');
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
  $this->addBuilderClass('ShowColumn');
  return $this;
}



/**
 * Query output
 * @return string
*/
public function sql()
{
	foreach($this->classBuilder as $builder)
  {
 	    $output = $this->callBuilder($builder);
 	    if($builder === 'Condition')
 	    {
 	        $output = sprintf('WHERE %s', $output);
 	    }
      $this->output[] = $output;
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
private function addBuilderClass(string $name)
{
    if(!in_array($name, $this->classBuilder))
    {
        $this->classBuilder[] = $name;
    }
}


/**
 * Condition fields
 * @param string $column 
 * @param mixed $value 
 * @param string $operator 
 * @return string
*/
private function conditionField($column, $value, $operator)
{
    $field = sprintf('`%s`', $column);
    return sprintf('%s %s %s', $field, $operator, '?');
}


/**
* Get buider class name
* @param string $builder
* @return string
*/
private function callBuilder($builder)
{
  $class = sprintf('\\JK\\Database\\ORM\\Builder\\%sBuilder', 
                  $builder
  );

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
  $this->classBuilder = [];
}



}