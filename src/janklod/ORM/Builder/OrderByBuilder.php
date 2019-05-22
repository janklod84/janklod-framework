<?php 
namespace JK\ORM\Builder;


/**
 * @package 
*/ 
class OrderByBuilder extends CustomBuilder
{
     
     /**
      * Build Order By
      * @return string
     */
     public function build()
     {
       	 if($orderBy = $this->params())
       	 {
              $orderString = '';
              foreach($orderBy as $orders)
              {
                   $orderString .= join(' ', $orders) . ', ';
              }
              return sprintf('ORDER BY %s', trim($orderString, ', '));
       	 }
     }


}