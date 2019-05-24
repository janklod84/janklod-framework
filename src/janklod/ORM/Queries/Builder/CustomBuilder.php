<?php 
namespace JK\ORM\Queries\Builder;


/**
 * @package 
*/ 
abstract class CustomBuilder
{
     
/**
* @var array params
* @var string $table
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
    return '`' . implode('`, `', $columns) . '`';
}


/**
* Get table
* @return string
*/
protected function table()
{
   $tableString = '';
   if($table = $this->get('table'))
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