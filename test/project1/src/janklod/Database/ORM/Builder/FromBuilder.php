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
     	 $from = $this->tableQuery();
         return sprintf('FROM %s', $from);
     }
}