<?php 
namespace app\controllers\blog;


use \Auth;
use \Url;
use \Query;

/**
 * @package app\controllers\blog\UserController 
*/ 
class UserController extends BaseController
{
     

/**
 * Do all behaviours before actions
 * 
 * @return 
*/
public function before()
{    
     // redirect user if is logged
     //if(Auth::isLogged())
     //{
          // redirect('/admin');
     //}
     
} 


/**
* Constructor
* 
* @param \JK\Container\Contracts\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     parent::__construct($app);
}


/**
* Action login
* 
* @return void
*/
public function login()
{
   if($this->request->isPost())
   {
        die('IS POST');
   }
   $title = 'Вход';
   $errors = [];
   $this->render('blog.users.login', compact('title', 'errors'));
}


/**
* Action register
* 
* @return void
*/
public function register()
{
   if($this->request->isPost())
   {
        die('IS POST');
   }
   $title = 'Регистрация';
   $errors = [];
   $this->render('blog.users.register', compact('title', 'errors'));
}


/**
 * Action profile
 * 
 * @return void
*/
public function profile()
{
   $this->render('blog.users.profile');
}

/**
 * Action Logout
 * 
 * @return void
*/
public function logout()
{

}


}