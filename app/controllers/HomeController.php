<?php 
namespace app\controllers;


use app\models\User\User;
use app\models\User\UserManager;
use \Q;
use \DB;
use \MyAlias;


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
     
     Q::setup(\DB::instance());
     
     $selects = [
       'username',
       'password',
       'role'
     ];
     
     $results = Q::table('users')->findAll($selects);
     debug($results);
} 


/**
* Action index
* @return void
*/
public function index()
{
    /*
     Q::table('users')->create([
         'username' => 'NewBrowner34'. $i,
         'password' => 'myNewBrower3'. $i,
         'role' => $i
        ]);
    */
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