<?php 
namespace JK\ORM;


/**
 * Class QueryBuilder
 * 
 * @package JK\ORM\QueryBuilder
*/
class QueryBuilder
{
   
/**
* @var string $table
* @var array  $sql
* @var array  $values
*/
protected $table = '';
protected $sql = '';
public $values = [];


/**
 * Constructor
 * 
 * @param string $table 
 * @return void
*/
public function __construct($table='')
{
	  $this->table = $table;
}


/**
 * Add table
 * 
 * @param string $table 
 * @return self
*/
public function table($table='')
{
	 $this->table = $table;
	 return $this;
}


/**
 * Get Table
 * 
 * @return string
*/
public function getTable()
{
    return $this->table;
}


/**
 * Select
 * 
 * @return self
*/
public function select(...$args)
{
   // $this->clear();
   $this->sql = sprintf('SELECT %s FROM %s', join(',', $args), $this->table);
   return $this;
}


/**
 * Select
 * 
 * @return self
*/
public function insert($params = [], $table='')
{
   // $this->clear();
   $this->table = $table;
   $this->values = array_values($params);
   $this->sql = sprintf('INSERT INTO `%s` ', $this->table);
   return $this;
}


/**
 * Select
 * 
 * @return self
*/
public function update($params = [], $table='')
{
   // $this->clear();
   $this->table = $table;
   $this->values = array_values($params);
   $this->sql = sprintf('UPDATE `%s` SET []', $this->table);
   return $this;
}

/**
 * Create query SQL
 * 
 * @return string
*/
public function sql()
{
	$sql = '';
    $sql = $this->sql;

    echo $sql, '<br>';
}



/**
 * Reset all data
 * 
 * @return void
*/
public function clear()
{
    $this->table = '';
    $this->sql   = '';
    $this->values = [];
}

}