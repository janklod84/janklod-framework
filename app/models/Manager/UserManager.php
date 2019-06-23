<?php 
namespace app\models\Manager;


use app\models\Entity\User;
use \Query;
use \Auth;

/**
 * @package app\models\Manager\UserManager 
*/ 
class UserManager  extends BaseManager
{
    
 /**
  * @var string $table
  * @var string $class
 */
 protected $table = 'user';
 protected $class = User::class;


/**
* Login 
* 
* @param string $username 
* @param string $password 
* @return void
*/
public function login($username, $password)
{
     $user = Query::table()->where('username', $username);
     if($user && password_verify($password, $user->getPassword()))
     {
           Auth::put($user);
           return true;
     }
     return false;
}


/**
 * Store data in to database
 * 
 * @param array $data 
 * @return bool
*/
public function save(array $data)
{
    if(Query::table()->create($data))
    {
        return true;
    }
    return false;
}

}