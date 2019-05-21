<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class DeleteBuilder extends CustomBuilder
{
     
     /**
      * Build from
      * @return string
     */
     public function build()
     {
     	 $table = $this->tableQuery();
         return sprintf('DELETE FROM `%s`', $table);
     }
}