<?php 
namespace JK\ORM\Builders;


/**
 * @package 
*/ 
class DescribeBuilder extends CustomBuilder
{
     
     /**
      * Build from
      * @return string
     */
     public function build()
     {
     	 $table = $this->table();
         return sprintf('DESCRIBE %s', $table);
     }
}