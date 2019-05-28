<?php 
namespace app\controllers;


use app\models\User\User;
use app\models\User\UserManager;
use JK\ORM\QQ;
use JK\Database\DatabaseManager;

/**
 * Base controller Back part of application
 * @package app\controllers\HomeController 
*/ 
class HomeController extends AppController
{
     
/**
* Action index
* @return void
*/
public function index()
{
   $user = new User();
   



   // 
   return $this->render('home/index');
}


/**
* Action about
* @return string
*/
public function about()
{
    $this->render('home/about');
}


/**
* Action contact
* @return void
*/
public function contact()
{
   if($this->request->isMethod('post'))
   {
       echo 'OK';
   }
   $this->render('home/contact');
}

}