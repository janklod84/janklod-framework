<?php 
namespace app\controllers;


/**
 * Base controller Back part of application
 * @package app\controllers\HomeController 
*/ 
class HomeController extends AppController
{
     
     public function index()
     {
     	  echo __METHOD__, '<br>';
            $this->render('home/index');
     }

     public function about()
     {
     	  echo __METHOD__;
     }


     public function contact()
     {
     	  echo __METHOD__;
     }

}