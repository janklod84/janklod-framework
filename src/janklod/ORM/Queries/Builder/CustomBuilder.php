<?php 
namespace JK\ORM\Queries\Builder;


/**
 * @package 
*/ 
abstract class CustomBuilder
{
     
/**
* @var array params
*/
protected $params;
protected $table;

/**
* Constructor
* @param array $params 
* @param string $table
* @return void
*/
public function __construct($params)
{
    $this->params = $params;
}


/**
 * Map if has table already sette
 * @param string $table 
 * @return string
*/
public function mapTable($table='')
{
     $this->table = $table;
}


/**
* Builder query
* @return string
*/
abstract public function build();


/**
* Field builder
* [ '`' . implode('`, `', $columns) . '`' ]
* @param array $columns 
* @return string
*/
protected function fields($columns = null)
{
    if(!empty($columns))
    {
        return '`' . implode('`, `', $columns) . '`';
    }
    return '*';
}


/**
* Get table
* @return string
*/
protected function table()
{
   $tableString = '';
   $table = $this->get('table') ?: $this->table;
   if($table)
   {
       $tableString .= sprintf('`%s`', $table);
       if($alias = $this->get('alias'))
       {
           $tableString .= ' AS '.$alias;
       }
       return $tableString;
   }
}


/**
* assign fields
* @param array $fields 
* @return string
*/
protected function assign($fields = [])
{
   $set = '';
   foreach($fields as $field)
   {
       $set .= sprintf(' `%s` = ?,', $field);
   }
   return trim($set, ',');
}


/**
* Get param
* @param string $key 
* @return mixed
*/
protected function get($key=null)
{
   if($this->has($key))
   {
      return $this->params[$key];
   }
   return null;
}


/**
* Get all params
* @return array
*/
public function params()
{
   return $this->params;
}


/**
* Determine if has param
* @param string $key 
* @return bool
*/
protected function has($key)
{
   return isset($this->params[$key]);
}
}