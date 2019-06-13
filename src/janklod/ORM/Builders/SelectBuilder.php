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
         $select =  $this->selected(
          $this->get('selects')
         );
         
         return sprintf('SELECT %s', $select);
     }

}