<?php 
namespace app\controllers\admin;


use JK\Routing\Controller;
use \Auth;

/**
 * @package app\controllers\admin\LoginController 
*/ 
class LoginController extends Controller
{
     

/**
 * Do action before callback
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
     # пользователь может попасть в систему 
     # только когда он будет авторизован
     if(Auth::isLogged())
     {
          redirect('/dashboard');
     }
     
} 


/**
* Constructor
* @param \JK\Container\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     parent::__construct($app);
}




/**
* Action index
* @return void
*/
public function index()
{
    
    $this->title('Вход', false);
    return $this->render('/admin/login/index');
}



}