<?php 
namespace JK\ORM\Builder;


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
     	 $table = $this->tableQuery();
         return sprintf('FROM %s', $table);
     }
}