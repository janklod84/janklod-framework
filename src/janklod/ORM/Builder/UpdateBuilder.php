<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class UpdateBuilder extends CustomBuilder
{
     
     /**
      * Build update
      * @return string
     */
     public function build()
     {
         $table = $this->tableQuery();
         return sprintf('UPDATE %s', $table);
     }
}