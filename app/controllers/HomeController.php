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
 * Debug
 * @var bool $debug [Give use details currencies ]
*/
// protected $debug = false;


/**
 * Availables properties
 * @var \app\models\User $user
 * @var bool $debug [Give use details currencies ]
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
   
    view('home/index');
   // return $this->render('home/index');
}


/**
* Action about
* @return string
*/
public function about()
{
    view('home/about');
    // $this->render('home/about');
}


/**
* Action contact
* @return void
*/
public function contact()
{
   // if method is post
   if($this->request->isPost())
   {
       // fetch post data
       $data = $this->request->post();
       debug($data);
   }
   // show render
   view('home/contact');
   // $this->render('home/contact');
}

}