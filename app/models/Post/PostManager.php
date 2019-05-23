<?php 
namespace app\models\Posts;


/**
 * @package app\models\Posts\PostManager
*/ 
class PostManager
{
	  
	 private $user;
	 
	 /**
	  * constructor
	  * @param type $user 
	  * @return void
	 */
	 public function __construct()
	 {
	 	  // debug($user);
	 	  $this->user = new Post();
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