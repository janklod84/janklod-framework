<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class SetBuilder extends CustomBuilder
{
     
     /**
      * Build set
      * @return string
     */
     public function build()
     {
         $set = $this->setField();
         return sprintf('SET %s', $set);
     }
}