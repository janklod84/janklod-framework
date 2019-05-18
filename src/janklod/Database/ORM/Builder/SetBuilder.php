<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class SetBuilder extends CustomBuilder
{
     
     /**
      * Build select
      * @return string
     */
     public function build()
     {
         debug($this->sql('set'));
         $set = '';
         return sprintf('SET %s', $set);
     }
}