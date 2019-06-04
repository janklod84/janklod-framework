<?php 
namespace app\controllers\admin;


use JK\Routing\Controller;
use \Auth;

/**
 * Base controller of admin
 * @package app\controllers\admin\AdminController 
*/ 
class AdminController extends Controller
{
     
/**
 * Do action before callback
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
     # если пользователь не авторизован
     # мы ему перенаправим на главную 
	 # в нашем случае на [login]
     if(!Auth::isLogged())
     {
          redirect('/');
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
}