<?php 
namespace JK\Database\ORM\Builder;


/**
 * @package 
*/ 
class LimitBuilder extends CustomBuilder
{
     
     /**
      * Build limit
      * @return string
     */
     public function build()
     {
     	 if($limit = $this->sql('limit'))
         {
             return sprintf(' LIMIT %s', $limit);
         }
     }
}