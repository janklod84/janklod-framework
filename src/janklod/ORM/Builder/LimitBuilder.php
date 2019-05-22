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
             $limited = sprintf(' LIMIT %s ', $this->get('limit'));
             if($offset = $this->get('offset'))
             {
                 $limited .= sprintf(' OFFSET %s ', $offset);
             }
             return $limited;
     }
}