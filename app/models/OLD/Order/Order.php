<?php 
namespace app\models\Order;


use JK\Database\ActiveRecord;


/**
 * @package app\models\Order\Order
*/ 
class Order extends ActiveRecord
{
	  
/**
* @var string $table
*/
protected $table = 'orders';


/**
* @var int $id
*/
public $id;


}