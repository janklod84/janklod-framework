<?php 
namespace JK\ORM\Queries\Builder;


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
         $select = '';

         // if not empty selects
         if(!empty($selects))
         {
             foreach($selects as $selected)
             {
                   if(is_array($selected))
                   {
                      $select = $this->fields($selected);
                   }
                   if(is_string($selected))
                   {
                       $select .= sprintf('`%s`,', $selected);
                   }
             }

         }else{
             
             $select = '*';
         }
         
         return sprintf('SELECT %s', trim($select, ','));
     }
}