<?php 
namespace JK\ORM\Builders;


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
         $orderString = '';
       	 if($orderBy = $this->params())
       	 {
              foreach($orderBy as $order)
              {
                   $orderString .= sprintf('%s %s, ', 
                                    $order['field'], 
                                    strtoupper($order['sort'])
                                  );
              }
             $orderString = sprintf('ORDER BY %s', trim($orderString, ', '));
       	 }
         return $orderString;
     }


}