<?php 
namespace app\controllers\admin;


use \Auth;
use \Query;
use \JK\ORM\QueryBuilder;
use \DB;
use app\models\Managers\UserManager;
use JK\Routing\Controller;


/**
 * @package app\controllers\admin\LoginController 
*/ 
class LoginController extends Controller
{
     

private $user;


/**
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
     Query::setup(\DB::instance());

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
     // $this->user = new UserManager($app);
}




/**
* Action index
* @return void
*/
public function index()
{
    
    // debug(Query::getTable()->findAll(['username', 'role']));

    $builder = new QueryBuilder();

    $data = [
      'username' => 'Michelle122',   
      'password' => md5('Qwerty'),  
      'role' => 3
    ];

    Query::table('users')
          ->create($data);
    
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