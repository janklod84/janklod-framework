<?php 
namespace app\controllers\frontend;


use app\models\Entity\User;
use app\models\Manager\UserManager;
use JK\ORM\QQ;
use JK\Database\DatabaseManager;


class HomeController extends SiteController
{
       
/**
* Action index
* @return void
*/
public function index()
{
  
   // Instance of connection
   $db = DatabaseManager::instance();

   // Add simple connection [connection must to be instance to PDO]
   // QQ::setup($db, 'users');
   QQ::setup($db, 'users');
   
   QQ::fetchClass('app\\models\\User\\User');
   $selects = [
       'username', 
       'password', 
       'role'
   ];
   $sql1 = QQ::sql()->select($selects)
                   ->from('orders', 'o')
                   ->where('id = ?', 6);
   $values = QQ::sql()->values;

   $sql = QQ::select($selects);
           // ->where('id', 4);
   $sql = QQ::select('username', 'test1', 'test2');
   die($sql);

   //$r = QQ::execute($sql, $values)->results();
   // $r = QQ::execute($sql, QQ::sql()->values)->results();
   
   //debug($r);
   

   QQ::output();
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