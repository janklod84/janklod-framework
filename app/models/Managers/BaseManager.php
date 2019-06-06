<?php 
namespace app\models\Managers;


use JK\Database\Model;
use app\models\Entities\User;



/**
 * @package app\models\Managers\BaseManager
*/ 
class BaseManager extends Model
{

/**
 * @var app\models\Entities\User
*/
protected $user;


 /**
  * constructor
  * @param JK\Container\ContainerInterface $app
  * @return void
 */
 public function __construct($app)
 {
 	  parent::__construct($app);
 	  $this->user = new User();
 }

}