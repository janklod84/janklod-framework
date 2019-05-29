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
 * @var \app\models\User $user
*/
protected $user;


/**
 * Do action before callback
 * Do all behaviours before actions
 * @return 
*/
public function before()
{
     $this->user = $this->load
                        ->model('User');
}


/**
* Action index
* @return void
*/
public function index()
{
   /* debug($this->user->findAll()); */
   
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