<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class OrderByBuilder extends CustomBuilder
{
     
     /**
      * Build conditions
      * @return string
     */
     public function build()
     {
       	 if($filters = $this->sql('orderBy'))
       	 {
              $orderString = '';
              foreach($filters as $orders)
              {
                   $orderString .= join(' ', $orders) . ', ';
              }
              return sprintf('ORDER BY %s', trim($orderString, ', '));
       	 }
     }


}