<?php 
namespace app\models\Manager;


use app\models\Entity\User;

/**
 * @package app\models\Manager\UserManager 
*/ 
class UserManager extends CustomManager
{
	 
  /**
   * @var User
  */
  private $user;


  /**
   * Constuctor
   * @return void
  */
  public function after()
  {
      $this->user = new User();
  }


  /**
   * Get all users
   * @return array
  */
  public function allUsers()
  {
      return $this->user->findAll();
  }

  
  /**
   * Get first user
   * @return array
  */
  public function firstUser()
  {
      return $this->user->findFirst();
  }


  /**
   * Find user by id
   * @param  $id 
   * @return array
  */
  public function findUserById($id)
  {
      
  }

  
  /**
   * Login user
   * @param string $username 
   * @param string $password 
   * @return bool
  */
  public function login($username, $password)
  {

  }

  
  /**
   * Assignement data
   * @return void
  */
  public function assign($data)
  {
      $this->user->assign($data);
  }


  /**
   * Save user
   * @param int $id
   * @return void
  */
  public function saveUser($id=null)
  {
  	  $this->user->setId($id);
  	  $this->user->save();
  }
}