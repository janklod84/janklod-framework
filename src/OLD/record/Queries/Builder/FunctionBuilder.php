<?php 
namespace JK\ORM\Queries\Builder;


/**
 * @package 
*/ 
class FunctionBuilder extends CustomBuilder
{
     
     /**
      * Build function
      * @return string
     */
     public function build()
     {
     	$column = $this->get('column');
     	$table  = $this->table();
     	$type   = $this->get('type');
        $alias  = $this->get('alias');
        // if has column and table defined
     	if($column !== '' && $table) 
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
              return sprintf('SELECT %s FROM %s ', $function, $table);
        }
     }
}