<?php 
namespace app\controllers\admin;


use app\models\User;
use app\models\User\UserManager;


/**
 * @package app\controllers\admin\LoginController 
*/ 
class LoginController extends AdminController
{
     

/**
 * Do action before callback
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
     \Q::setup(\DB::instance());
     \Q::addTable('users');
     $user = new User($this->app);
     
     /*
     for($i=1; $i < 5; $i++)
     {
          Q::getTable()->create([
            'username' => 'John' . $i,
            'password' => md5('John'. $i),  
            'role'     => $i 
          ]);
     }
     */

     // $user->setId(10);
     // $user->setUsername('NEW Record JK 111!');
     // $user->setPassword(password_hash('DDWE', PASSWORD_BCRYPT));
     
     // $lastId = Q::getTable()->store($user);
     // echo $lastId;
} 


/**
* Action index
* @return void
*/
public function index()
{

    /*
     Q::table('users')->create([
         'username' => 'NewBrowner34'. $i,
         'password' => 'myNewBrower3'. $i,
         'role' => $i
        ]);
    */
    return $this->render('home/index');
}


/**
* Action about
* @return string
*/
public function about()
{
   return $this->render('home/about');
}


/**
* Action contact
* @return void
*/
public function contact()
{
   if($this->request->isPost())
   {
       $data = $this->request->post();
       debug($data);
   }
   return $this->render('home/contact');
}

}