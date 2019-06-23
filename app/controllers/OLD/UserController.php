<?php 
namespace app\controllers\blog;


use \Auth;
use \Flash;
use \Url;
use app\models\Manager\UserManager;


/**
 * @package app\controllers\blog\UserController 
*/ 
class UserController extends BaseController
{
     

private $userManager;

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
     $this->userManager = new UserManager();
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
        $login = $this->request->post('login');
        $username = $this->request->post('username');

        if($this->isValidData() && $this->userManager->login($login, $username))
        {
              die('LOGGED');
        }
   }
   $title = 'Вход';
   $url = '/login';
   $this->form(compact('title', 'url'));
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
        // data already cleaned from class request
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        $data = [
          'username' => $username,
          'password' => password_hash($password, PASSWORD_BCRYPT)
        ];
        if($this->isValidData() && $this->userManager->save($data))
        {
             // Установление сообщение об успехе
             Flash::message('success', 'Вы успешно зарегистрирован :)');
             redirect('/login');
        }
   }
   $title = 'Регистрация';
   $url = '/register';
   $this->form(compact('title', 'url'));
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
    return Auth::logout();
}


/**
 * Form
 * 
 * @param array $data 
 * @return void
*/
private function form($data=[])
{
    $data['errors'] = $this->validation->errors();
    $this->render('blog.users.form', $data);
}


/**
* Verify if data match or correctly parse
* проверяю если у нас валидные данные с Поста
* при помощью валидатор в ппинципе она должна находиться в Модел
* но временно оставляю здесь так как все сервисы еще не готов..
* 
* @return bool
*/
private function isValidData(): bool
{
      
   // проверка если у нас валидные данные с Поста
   // при помощью валидатор
   $validation = $this->validation->check($this->request->post(), [
         'username' => [
             'required' => true,
             'min' => 3,
             'max' => 150,
             'unique' => 'user'
          ],
         'password' => [
             'required' => true,
             'min' => 6,
             'max' => 200
         ]
     ]);

   return $validation->passed();
}



}