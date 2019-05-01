<?php 
namespace app\controllers;


/**
 * @package app\controllers\HomeController
*/
class HomeController  extends BaseController
{
       

       // protected $layout = 'admin';

       /**
        * Action index
        * @return void
       */
	   public function index()
	   {
           $this->render('home/index');
	   }
       
       
       /**
        * Action about
        * @return string
       */
       public function about()
       {
           echo 'Here';
       }


	   /**
        * Action contact
        * @return void
       */
	   public function contact()
	   {
	   	   if($this->isPost())
	   	   {
	   	   	   debug($this->request->post());
	   	   }

	   	   $this->layout = 'admin';
	   	   $this->render('home/contact');
	   }

}