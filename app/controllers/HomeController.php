<?php 
namespace app\controllers;


use app\models\User\User;
use app\models\User\UserManager;
use \Q;
use \DB;



/**
 * Base controller Back part of application
 * @package app\controllers\HomeController 
*/ 
class HomeController extends AppController
{
     

/**
 * Do action before callback
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
   $config = [
     'dsns' => 'mysql:host=localhost;port=3306;dbname=dbproject;charset=utf8',
     'user' => 'root',
     'password' => 'root'
   ];

   // Q::setup(\DB::instance(), 'users');

   Q::connect($config, 'users');



   $c = Q::getTable()->create([
     'username' => 'NewBrowner9',
     'password' => 'myNewBrower34',
     'role' => 10
   ]);
   
    debug($c);
    echo Q::lastId();
}


/**
* Action index
* @return void
*/
public function index()
{

    return $this->render('home/index');
}


/**
* Action about
* @return string
*/
public function about()
{
   return $this->render('home/about');
}


/**
* Action contact
* @return void
*/
public function contact()
{
   if($this->request->isPost())
   {
       $data = $this->request->post();
       debug($data);
   }
   return $this->render('home/contact');
}

}