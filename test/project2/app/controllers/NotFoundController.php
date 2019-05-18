<?php 
namespace app\controllers;


/**
 * @package app\controllers\NotFoundController
*/
class NotFoundController 
{

	   /**
        * Action contact
        * @return void
       */
	   public function index()
	   {
	   	   exit('404 Not Found');
	   }

}