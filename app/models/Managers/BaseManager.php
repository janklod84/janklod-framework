<?php 
namespace app\models\Managers;


use JK\Database\Model;


/**
 * @package app\models\Managers\BaseManager
*/ 
class BaseManager extends Model
{
	  
	 /**
	  * constructor
	  * @param JK\Container\ContainerInterface $app
	  * @return void
	 */
	 public function __construct($app)
	 {
	 	  parent::__construct($app);
	 }

}