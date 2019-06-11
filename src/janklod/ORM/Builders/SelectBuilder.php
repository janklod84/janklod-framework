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
         $select = '*';
         
         if($selects = $this->params())
         {
             if(is_array($selects[0]))
             {
                  $select = $this->fields($selects[0]);
             }else{
                  $select = $this->fields($selects);
             }

         }
         
         $select =  trim($select, ','); 
         return sprintf('SELECT %s', $select);
     }
}