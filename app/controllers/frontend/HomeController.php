<?php 
namespace app\controllers\frontend;

use app\models\Manager\UserManager;


class HomeController extends BaseController
{
       
     /**
      * Action index
      * @return void
     */
	   public function index()
	   {
         $user = new UserManager();
         $users = $user->getAllUsers(); // debug($users);
         $user->saveUser(3);
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
	   	   if($this->isPost())
	   	   {
             /*
	   	   	   $posted = $this->request->post();
             $this->user->assign($posted);
             $this->user->saveUser();
             */
	   	   }
	   	   $this->render('home/contact');
	   }
}