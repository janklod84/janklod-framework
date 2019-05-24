<?php 
namespace app\models\User;


use JK\Database\ActiveRecord;


/**
 * @package app\models\User\User 
*/ 
class User //extends ActiveRecord
{
	  
	  /**
	   * @var string $table
	  */
      protected $table = 'users';
      

	  /**
	   * @var int    $id
	   * @var string $username
	   * @var string $password
	   * @var mixed  $role
	  */
	  protected $id;
	  protected $username;
	  protected $password;
	  protected $role = 1;

      
      /**
       * Set id
       * @param int $id 
       * @return void
      */
	  public function setId($id)
	  {
	  	  $this->id = $id;
	  }


	  /**
       * Get id
       * @return int
      */
	  public function getId()
	  {
	  	  return $this->id;
	  }


	  /**
       * Set username
       * @param string $username 
       * @return void
      */
	  public function setUsername($username)
	  {
	  	  $this->username = $username;
	  }


	  /**
       * Get username
       * @return string
      */
	  public function getUsername()
	  {
	  	  return $this->username;
	  }


	  /**
       * Set password
       * @param string $password 
       * @return void
      */
	  public function setPassword($password)
	  {
	  	  $this->password = $password;
	  }


	  /**
       * Get password
       * @return string
      */
	  public function getPassword()
	  {
	  	  return $this->password;
	  }


	  /**
       * Set role
       * @param mixed $role 
       * @return void
      */
	  public function setRole($role)
	  {
	  	  $this->role = $role;
	  }


	  /**
       * Get role
       * @return string
      */
	  public function getRole()
	  {
	  	  return $this->role;
	  }
}