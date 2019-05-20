<?php 
namespace JK\Database\ORM\Builder;


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
         $table = $this->tableQuery();
         return sprintf('TRUNCATE TABLE `%s`', $table);
     }
}