<?php 
namespace JK\ORM\Builders;


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
             if(is_array($selects[0]))
             {
                  $select = $this->fields($selects[0]);
             }else{
                  $select = $this->fields($selects);
             }

         }

         $select =  trim($select, ','); 
         if($this->table)
         {
             $select .= sprintf(' FROM `%s` ', $this->table);
         }
         
         return sprintf('SELECT %s', $select);
     }
}