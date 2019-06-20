<?php 
namespace app\controllers\admin;


use \Auth;
use \Query;
use JK\Routing\Controller;
use app\models\User;
use \Form;


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
     // redirect user if is logged
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
}




/**
* Action index
* @return void
*/
public function index()
{

    $options = [
      'Lundi',
      'Mardi',
      'Mercredi',
      'Jeudi',
      'Vendredi',
      'Samedi',
      'Dimanche',
    ];



	/*
    $form = new Form();
    echo '<!DOCTYPE html>'.PHP_EOL;
    $form->open('/sign-in', 'POST', ['class'  => 'sign-in']);
    $form->csrfInput();
    echo '<h3>Formulaire</h3>';
    $form->hidden();
    $form->input(['class' => 'form-control', 'id'=> 'password',], 'password', 'Password');
    $form->close();
    */
	
    $this->show();
}


private function Logged()
{

     $user = [
     'username' => 'Jean',
     'password' => md5('jean'),   
     'role'     => 1
    ];
    // Auth::add($user);

    if(Auth::isLogged())
    {
       exit('Is Logged!');
    }
}

private function formTest()
{
     $data = [
     'username' => 'Jean',
     'password' => md5('jean'),   
     'role'     => 1
   ];
   $form = new Form($data);
   
   // $form->input(['class:{form-control}', 'id:{password}',], 'password', 'Password');
   
    // $form = new Form();
    // echo '<!DOCTYPE html>'.PHP_EOL;
    // $form->open('/sign-in', 'POST', ['class'  => 'sign-in']);
    // $form->html('<h3>Formulaire</h3>');
    // $form->hidden();
    // $form->input(['class' => 'form-control', 'id'=> 'password',], 'password', 'Password');
    // $form->close();
    
    // $form->open('/logout', 'POST', ['id'  => 'form']);
    // $form->html('<h1>Formulaire</h1>');
    // $form->hidden();
    // $form->input(['class' => 'form-control', 'id'=> 'password',], 'password', 'Password');
    // $form->close();
  
    
    // OUTPUT
    // Query::output();
}



private function queryTest()
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
private function testIsPost()
{
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
  
    $results = Query::execute('SELECT * FROM `users`')->results();
    
    debug($results);

    $this->setMeta('Вход');
    $this->render('/admin/login/form');
}


private function hash()
{
   $this->request->session()
    ->put('sess.user_---af2f4a9befcc57c1e65e8904b38b66c4ae9337d9', true);
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