<?php 
namespace JK\ORM\Builders;


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
* 
* @param array $params 
* @param string $table
* @return void
*/
public function __construct($params, $table='')
{
    $this->params = $params;
    $this->table  = $table;
}


/**
* Builder query
* @return string
*/
abstract public function build();


/**
* Get selected columns
*
* @param array $selects
* @return string
*/
protected function selected($selects=[])
{
    $columns = $this->get_select_columns($selects);
    if(!empty($columns))
    {
        $selected = '';
        foreach($columns as $column)
        {
           if(is_string($column))
           {
              $selected .= sprintf('`%s`,', $column);
           }else{
              $selected = $this->attributes($column);
           }
       }
       return trim($selected, ',');
    }
    return "*";

}


/**
 * Get selects
 * 
 * @param array $columns 
 * @return array
*/
protected function get_select_columns($columns)
{
     if(!empty($columns))
     {
        return is_array($columns[0]) ? $columns[0] : $columns;
     }
}


/**
 * Build attributes
 * 
 * @param array $columns
 * @return string
*/
protected function attributes($columns)
{
    if(is_array($columns) && !empty($columns))
    {
        return '`' . implode('`, `', $columns) . '`';
    }
}



/**
* Get table
* @return string
*/
protected function table()
{
   $tableString = '';
   if($this->table)
   {
       $tableString .= sprintf('`%s`', $this->table);
       if($alias = $this->get('alias'))
       {
           $tableString .= ' AS '.$alias;
       }
   }
   return $tableString;
}


/**
* assign fields
* 
* @param array $fields 
* @return string
*/
protected function assign($fields = [])
{
   $set = [];
   foreach($fields as $field)
   {
       array_push($set, sprintf(' `%s` = ?', $field));
   }
   return join(',', $set);
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