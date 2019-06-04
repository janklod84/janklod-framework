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
    if($this->request->isPost())
    {
         die('OK');
    }
    $this->title('Вход', false);
    $this->render('/admin/login/form');
}


private function hash()
{
   /*
   $this->request->session()
    ->put('sess.user_---af2f4a9befcc57c1e65e8904b38b66c4ae9337d9', true);
    */
}

}