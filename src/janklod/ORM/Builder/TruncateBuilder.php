<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class TruncateBuilder extends CustomBuilder
{
     
     /**
      * Build update
      * @return string
     */
     public function build()
     {
         $table = $this->table();
         return sprintf('TRUNCATE TABLE %s', $table);
     }
}