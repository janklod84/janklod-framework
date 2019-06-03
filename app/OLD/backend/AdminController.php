<?php 
namespace app\controllers\backend;

use app\controllers\BaseController;


/**
 * Base controller Back part of application
 * @package app\controllers\backend\AdminController 
*/ 
class AdminController extends BaseController 
{
     
     /**
      * Construct
      * @param \JK\Container\ContainerInterface $app 
      * @return void
     */
	 public function __construct($app)
	 {
	 	 parent::__construct($app);	
	 }
}