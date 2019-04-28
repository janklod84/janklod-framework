<?php 
namespace app\controllers;


/**
 * @package app\controllers\HomeController
*/
class HomeController 
{
       
       /**
        * Action index
        * @return void
       */
	   public function index()
	   {
	   	   echo 'HomeController::index', '<br>';
	   }


	   /**
        * Action about
        * @return void
       */
	   public function about()
	   {
	   	   echo 'HomeController::about', '<br>';
	   }


	   /**
        * Action contact
        * @return void
       */
	   public function contact()
	   {
	   	   echo 'HomeController::contact', '<br>';
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