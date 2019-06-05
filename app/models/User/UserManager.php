<?php 
namespace app\models\User;


use JK\Database\Model;


/**
 * @package app\models\User\UserManager
*/ 
class UserManager extends Model
{
	  
	  
	 private $user;
	 
	 /**
	  * constructor
	  * @param type $user 
	  * @return void
	 */
	 public function __construct($app)
	 {
	 	  parent::__construct($app);
	 	  $this->user = new User();
	 }

     
     /**
      * Get User
      * @return app\models\User\User
     */
     public function getUser()
     {
     	 return $this->user;
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