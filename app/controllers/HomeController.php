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
           echo 'Welcome::index <br>';
	   }


	   /**
        * Action about
        * @return void
       */
	   public function about($slug, $id)
	   {
	   	   echo $slug . ' & ' . $id;
	   	   echo 'HomeController::about', '<br>';
	   }


	   /**
        * Action contact
        * @return void
       */
	   public function contact()
	   {
	   	   return 'HomeController::contact';
	   }


	   /**
        * Action submit
        * @return void
       */
	   public function submit()
	   {
	   	   echo 'HomeController::submit', '<br>';
	   }
}