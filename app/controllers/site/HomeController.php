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
   // $query = new \JK\ORM\Query(
   //    \JK\Database\DatabaseManager::instance(),  
   //    'users'
   // );

    $db = \JK\Database\DatabaseManager::instance();

    $query = new \JK\ORM\Query();
    $results = $query->connect($db)
                     ->fetchClass('app\\models\\User')
                     ->table('users')
                     ->read(2);
    
    debug($results);

   $data = ['username' => 'Brown1'];
   // $query->update($data, 1);

   /*
     // set fetch mode 
     $query->fetchClass('app\\models\\User'); 
   */
    
 
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