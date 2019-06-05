<?php 
namespace app\models\User;


/**
 * @package app\models\User\UserManager
*/ 
class UserManager extends BaseManager
{
	  

/*  
protected $entity;


/**
* @return void
*//*
public function onConstruct($entity)
{
	  $this->entity = $entity;
}

 
/**
* Get User
* @return app\models\User\User
*//*
public function entity()
{
	   return $this->entity;
}


 /**
  * User login
  * @param string $username 
  * @param string $password 
  * @return bool
 *//*
public function login($username, $password)
{
      $user = $this->user->findBy('username', $username);
      if($user && password_verify($password, $user->password))
      {
      	    // sauvegarde user dans la session
      	    $key = \Auth::key(); // get auth key
      	    $this->request->session()->put($key, $user);
      	    return true;
      }
      return false;
}
*/


}