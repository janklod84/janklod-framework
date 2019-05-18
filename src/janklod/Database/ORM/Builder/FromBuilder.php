<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class FromBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
     	 $from = $this->sql['table'];
     	 if($alias = $this->sql['table.alias'])
     	 {
     	 	$from .= ' AS ' . $alias;
     	 }
         return sprintf('FROM %s', $from);
     }
}