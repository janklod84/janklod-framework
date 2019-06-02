<?php 
namespace app\controllers\admin;


use JK\Routing\Controller;


/**
 * @package app\controllers\NotFoundController
*/
class NotFoundController extends Controller
{
      
      protected $layout = 'error';
      
	   /**
        * Action contact
        * @return void
       */
	   public function index()
	   {
	   	   /* exit('404 Not Found <br>'. __METHOD__); */
	   	   return $this->render('errors/404');
	   }

}