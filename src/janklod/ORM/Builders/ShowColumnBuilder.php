<?php 
namespace JK\ORM\Builders;


/**
 * @package 
*/ 
class ShowColumnBuilder extends CustomBuilder
{
     
     /**
      * Build update
      * @return string
     */
     public function build()
     {
         $table = $this->table();
         return sprintf(' SHOW COLUMNS FROM %s', $table);
     }
}