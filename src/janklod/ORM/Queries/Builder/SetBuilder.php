<?php 
namespace JK\ORM\Queries\Builder;


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
         $set = $this->assign($this->params());
         return sprintf('SET %s', $set);
     }
}