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
     	 $selects = $this->params();
         $select = '*';
         if(!empty($selects))
         {
             $select = $this->fields($selects);
         }
         
         return sprintf('SELECT %s ', $select);
     }
}