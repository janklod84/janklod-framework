<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class SelectBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
     	 $select = $this->sql('select');
         if(empty($select))
         {
             $select = '*';
         }else{
             $select = implode(', ', $select);
         }
         
         return sprintf('SELECT %s', $select);
     }
}