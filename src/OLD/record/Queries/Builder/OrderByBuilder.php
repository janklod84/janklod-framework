<?php 
namespace JK\ORM\Queries\Builder;


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
              foreach($orderBy as $order)
              {
                   $orderString .= sprintf('%s %s, ', 
                                    $order['field'], 
                                    strtoupper($order['sort'])
                                  );
              }
              return sprintf('ORDER BY %s', trim($orderString, ', '));
       	 }
     }


}