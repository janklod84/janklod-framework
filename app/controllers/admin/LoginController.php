<?php 
namespace app\controllers\admin;


use \Auth;
use \Query;
use JK\Routing\Controller;
use app\models\User;



/**
 * @package app\controllers\admin\LoginController 
*/ 
class LoginController extends Controller
{
     

/**
 * Do all behaviours before actions
 * 
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
* 
* @param \JK\Container\Contracts\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     parent::__construct($app);
     /* debug(\DB::connect('users')->findAll()); */
}




/**
* Action index
* @return void
*/
public function index()
{

  
  

 
    Query::output();
    $this->show();
}


public function query()
{
    // Fetch all users : User::all();
    // Fetch one record by id :  User::one(1);
    // Fetch where : User::where('username', 'Michelle124')
    // Delete user where id = 5 : User::delete(5)
    // Show table columns; debug(\DB::connect('users')->columns());
    // Describe table : debug(\DB::connect('users')->describe());

}


private function show()
{
    $this->setMeta('Вход');
    $this->render('/admin/login/form');
}


/**
* Action index
* @return void
*/
public function indexOLD()
{
    /*
    if($this->request->isPost())
    {
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        
        $post = $username . ' - ' . $password;
        die($post);
      
        if($this->user->login($username, $password))
        {
             die('OK');
        }
    }
    debug(\DB::instance());
    */
    


    $results = Query::execute('SELECT * FROM `users`')->results();
    
    debug($results);

    $this->setMeta('Вход');
    $this->render('/admin/login/form');
}


private function hash()
{
   /*
   $this->request->session()
    ->put('sess.user_---af2f4a9befcc57c1e65e8904b38b66c4ae9337d9', true);
   */
}

private function reference()
{
    if($this->request->isPost())
    {
         $host = $this->request->host();
         $hash = 'session.user_---'. sha1($host);
         die($hash);
    }
    $this->setMeta('Вход');
    $this->render('/admin/login/form');
}

}