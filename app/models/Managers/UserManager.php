<?php 
namespace app\models\User;


use JK\Database\Model;


/**
 * @package app\models\User\UserManager
*/ 
class UserManager extends BaseManager
{
	  
	  
private $user;


/**
* constructor
* @param app\models\Entities\User $user 
* @return void
*/
public function onConstruct()
{
	    $this->user = new User();
}

 
/**
* Get User
* @return app\models\User\User
*/
public function getUser()
{
	   return new User();
}


 /**
  * User login
  * @param string $username 
  * @param string $password 
  * @return bool
 */
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

}