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
     	 $selects = $this->sql('select');
         if(empty($selects))
         {
             $select = '*';
         }else{
             $select = $this->fieldQuery($selects);
         }
         
         return sprintf('SELECT %s', $select);
     }
}