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

}