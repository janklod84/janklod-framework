<?php 
namespace app\controllers\site;

use app\models\Manager\UserManager;
use app\models\Entity\User;
use JK\ORM\QueryBuilder;


class HomeController extends BaseController
{
       
/**
* Action index
* @return void
*/
public function index()
{
   $builder = new QueryBuilder();
     
   echo $builder->select('id', 'test')->from('users', 'u');
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