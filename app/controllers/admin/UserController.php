<?php 
namespace app\controllers\admin;

use app\controllers\AppController;


/**
 * Base controller Back part of application
 * @package app\controllers\admin\UserController 
*/ 
class UserController extends AppController
{
     
     protected $layout = 'admin';


     public function before() {}
   
     public function login()
     {
         return $this->render('user/login');
     }



     //public function after(){}

}