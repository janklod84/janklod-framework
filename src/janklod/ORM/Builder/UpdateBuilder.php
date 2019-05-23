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
         $table = $this->table();
         $update = sprintf('UPDATE %s ', $table);
         if($columns = $this->get('columns'))
         {
         	  $update .= sprintf(' SET %s ', $this->assign($columns));
         }
         return $update;
     }
}