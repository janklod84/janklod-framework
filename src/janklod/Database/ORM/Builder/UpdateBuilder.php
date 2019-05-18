<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class UpdateBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
         $table = $this->tableQuery();
         return sprintf('UPDATE %s', $table);
     }
}