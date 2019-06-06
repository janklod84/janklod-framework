<?php 
namespace app\models\Managers;


/**
 * @package app\models\Managers\UserManager
*/ 
class UserManager extends BaseManager
{


/**
  * User login
  * @param string $username 
  * @param string $password 
  * @return bool
*/
public function login($username, $password)
{
     /*
      $user = $this->user->findBy('username', $username);
      echo password_hash($password, PASSWORD_DEFAULT);
      debug($user, true);

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