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
protected $table  = '';
protected $sql = [];
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
 * Select
 * 
 * @return self
*/
public function select(...$args)
{
   $this->clear();
   $this->sql['select'] = $args;
   return $this;
}


/**
 * Reset all data
 * 
 * @return void
*/
public function clear()
{
    $this->table  = '';
    $this->sql    = [];
    $this->values = [];
}

}