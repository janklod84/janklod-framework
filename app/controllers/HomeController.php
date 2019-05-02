<?php 
namespace app\controllers;


/**
 * @package app\controllers\HomeController
*/
class HomeController  extends BaseController
{
       

     /**
      * Action index
      * @return void
     */
	   public function index()
	   {
           $site = 'JK Production';
           $posts = ['name' => 'article1', 'test' => 'test2'];
           $this->set(compact('site', 'posts'));
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
      * Action about
      * @return string
     */
     public function test()
     {
        $this->layout = 'test';
         $this->render('home/test');
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