<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class WhereBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
         $where = implode(' AND ', array_values($this->sql('where')));
     	 return sprintf('%s', $where);
     }
}