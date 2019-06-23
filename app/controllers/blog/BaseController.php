<?php 
namespace app\controllers\blog;


use JK\Routing\Controller;
use \Auth;

/**
 * Base controller of Blog
 * 
 * @package app\controllers\blog\BaseController 
*/ 
class BaseController extends Controller
{
     
/**
 * Do action before callback
 * 
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
	 # Если ползователь не авторизован
	 # перенаправлю на главную
     if(!Auth::isLogged())
     {
         redirect('/login');
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