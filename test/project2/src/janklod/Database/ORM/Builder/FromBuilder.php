<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class FromBuilder extends CustomBuilder
{
     
     /**
      * Build from
      * @return string
     */
     public function build()
     {
     	 $from = $this->tableQuery();
         return sprintf('FROM %s', $from);
     }
}