<?php 
namespace app\models\Managers;


/**
 * @package app\models\Managers\UserManager
*/ 
class UserManager extends BaseManager
{
	  

/**
* @return void
*/
public function onConstruct()
{
	  
}




/**
  * User login
  * @param string $username 
  * @param string $password 
  * @return bool
*/
public function login($username, $password)
{
      return true;

      /*
      $user = $this->user->findBy('username', $username);
      if($user && password_verify($password, $user->password))
      {
      	    // sauvegarde user dans la session
      	    $key = \Auth::key(); // get auth key
      	    $this->request->session()->put($key, $user);
      	    return true;
      }
      return false;
      */
}



}