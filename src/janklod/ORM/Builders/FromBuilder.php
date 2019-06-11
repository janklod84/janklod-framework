<?php 
namespace JK\ORM\Builders;


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
     	 if($table = $this->table())
     	 {
            return sprintf('FROM %s', $table);
         }
     }
}