<?php 
namespace JK\ORM\Builder;


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
         $table = $this->tableQuery();
         return sprintf(' SHOW COLUMNS FROM %s', $table);
     }
}