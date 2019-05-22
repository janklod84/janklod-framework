<?php 
namespace app\controllers\admin;

use JK\Routing\Controller;


/**
 * Base controller Back part of application
 * @package app\controllers\admin\BaseController 
*/ 
class BaseController extends Controller 
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