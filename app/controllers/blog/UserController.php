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
   $errors = [];
   if($this->request->isPost())
   {
        $username = $this->request->post('username');
        $password = $this->request->post('password');
       
        if($this->userManager->login($username, $password))
        {
              // Установление сообщение об успехе
             Flash::message('success', 'Вы успешно авторизован :)');
             redirect('/');

        }else{
           $this->validation->addError('Не верный логин или пароль!(');
        }
   }
   $title = 'Вход';
   $url = '/login';
   $errors = $this->validation->errors();
   $data = $this->request->post();
   $this->render('blog.users.login', compact('title', 'url', 'errors', 'data'));
   // blog.users.login или blog/users/login
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
        $email    = $this->request->post('email');
        $data = [
          'username' => $username,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'email'    => $email
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
   $errors = $this->validation->errors();
   $data = $this->request->post();
   $this->render('blog.users.register', compact('title', 'url', 'errors', 'data'));
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
    if(Auth::logout())
    {
        redirect('/');
    }
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
   $validation = $this->validation->check($this->request->post(), [
         'username' => [
             'required' => true,
             'min' => 3,
             'max' => 150
          ],
          'email' => [
             'required' => true,
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