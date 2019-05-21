<?php 
namespace JK\ORM\Builder;


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
             $limited = sprintf(' LIMIT %s ', $limit[0]);
             if($offset = $limit[1])
             {
                 $limited .= sprintf(' OFFSET %s ', $offset);
             }
             return $limited;
         }
     }
}