<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class FunctionBuilder extends CustomBuilder
{
     
     /**
      * Build from
      * @return string
     */
     public function build()
     {
     	$column = $this->sql('column');
     	$table  = $this->tableQuery();
     	$type = $this->sql('type');
        $alias = $this->sql('alias');

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
            return $function;
        }
     }
}