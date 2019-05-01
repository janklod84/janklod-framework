<?php 
namespace app\controllers;


use JK\Routing\Controller;


/**
 * @package app\controllers\BaseController 
*/ 
class BaseController extends Controller 
{
     
     /**
      * Construct
      * @param ContainerInterface $app 
      * @return void
     */
	 public function __construct($app)
	 {
	 	 parent::__construct($app);
	 }
}