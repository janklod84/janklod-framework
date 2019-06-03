<?php 
namespace app\models\Order;


/**
 * @package app\models\Order\OrderManager
*/ 
class OrderManager
{
	  
	  
	 private $order;
	 
	 /**
	  * constructor
	  * @param type $user 
	  * @return void
	 */
	 public function __construct()
	 {
	 	  $this->order = new Order();
	 }

}