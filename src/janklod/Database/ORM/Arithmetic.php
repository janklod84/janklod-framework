<?php 
namespace JK\Database\ORM;


/**
 * @package JK\Database\ORM\Arithmetic
*/
class Arithmetic 
{
  
/**
* @var QueryBuilder
*/
private $queryBuilder;


/**
* Constructor
* @return void
*/
public function __construct()
{
     $this->queryBuilder = new QueryBuilder();
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
      return $this->makeQuery($column, $table, 'COUNT', $alias);
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
      return $this->makeQuery($column, $table, 'AVG', $alias);
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
      return $this->makeQuery($column, $table, 'SUM', $alias);
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
      return $this->makeQuery($column, $table, 'MAX', $alias);
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
      return $this->makeQuery($column, $table, 'MIN', $alias);
}



/**
 * Query Maker
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
protected function makeQuery(
$column='', 
$table = 'no-table', 
$type=null,   
$alias = null
)
{
     if(!empty($column))
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

          return $this->queryBuilder
                      ->select($function)
                      ->from($table);
     }
     return $this;
} 


}