<?php 
namespace app\controllers\admin;

use \JK\Http\Request;

/**
 * Base controller Back part of application
 * @package app\controllers\admin\HomeController 
*/ 
class HomeController
{
     

     public function index(Request $request)
     {
            debug($request);
     	  echo __METHOD__;
     }

     public function about()
     {
     	  echo __METHOD__;
     }
     

     public function contact(int $id)
     {
            echo '<br>Contact number : '.$id, '<br>';
            echo __METHOD__;
     }


     public function contactFix(Request $request, int $id=null)
     {
            debug($request);
            echo 'Contact number : '.$id;
            echo __METHOD__;
     }


     public function contactQ(Request $request, $arguments)
     {
            debug($request);
            echo 'Contact number : '. debug($arguments);
     	  echo __METHOD__;
     }

}