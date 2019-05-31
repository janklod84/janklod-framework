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
             if(is_array($selects[0]))
             {
                  $select = $this->fields($selects[0]);
             }else{
                  $select = $this->fields($selects);
             }

         }else{
             
             $select = '*';
         }
         
         $select =  trim($select, ','); 
         if($this->table)
         {
             $select .= sprintf(' FROM `%s` ', $this->table);
         }
         
         return sprintf('SELECT %s', $select);
     }
}