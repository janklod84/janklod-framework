<?php 
namespace app\controllers\admin;


/**
 * Base controller of admin
 * @package app\controllers\admin\AdminController 
*/ 
class DashboardController extends AdminController
{
     
     /**
      * Action index
      * @return void
     */
     public function index()
     {
     	  die('WELCOME TO ADMIN');
     	  $this->render('/admin/dashboard/index');
     }
}