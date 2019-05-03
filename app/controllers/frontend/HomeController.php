<?php 
namespace app\controllers\frontend;


/**
 * @package app\controllers\frontend\HomeController 
*/
class HomeController extends BaseController
{
       
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
	   	   	   debug($this->request->post());
	   	   }
	   	   $this->render('home/contact');
	   }
}