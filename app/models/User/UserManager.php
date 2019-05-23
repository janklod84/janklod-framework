<?php 
namespace app\models\User;


/**
 * @package app\models\User\UserManager
*/ 
class UserManager
{
	  
	 private $user;
	 
	 /**
	  * constructor
	  * @param type $user 
	  * @return void
	 */
	 public function __construct()
	 {
	 	  $this->user = new User();
	 }


	 public function getAll()
	 {
	 	 debug($this->user->findAll());
	 }


	 public function createUser($params = [])
	 {
	 	  return $this->user
	 	             ->insert($params);
	 }
}