<?php 
namespace JK\ORM\Builder;


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
         $select = '*';
         if(!empty($selects))
         {
             $select = $this->fieldQuery($selects);
         }
         
         return sprintf('SELECT %s ', $select);
     }
}