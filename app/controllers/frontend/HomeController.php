<?php 
namespace app\controllers\frontend;


use app\models\Entity\User;
use app\models\Manager\UserManager;


class HomeController extends SiteController
{
       
/**
* Action index
* @return void
*/
public function index()
{
    // debug($this->user);

    // $this->user->createUser(['username' => 'Thomas2', 'password' => sha1('test')]);
    $this->user->getAll();
   
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
     
     debug($this->request->post());
     die('IsPost');
     /*
	   	   $posted = $this->request->post();
     $this->user->assign($posted);
     $this->user->saveUser();
     */
	   }
	   $this->render('home/contact');
}
}