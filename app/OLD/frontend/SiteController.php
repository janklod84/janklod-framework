<?php 
namespace app\controllers\frontend;

use app\controllers\BaseController;


/**
 * Base controller Front part of application
 * @package app\controllers\frontend\SiteController 
*/ 
class SiteController extends BaseController 
{
     
   /**
     * Construct
     * @param \JK\Container\ContainerInterface $app 
     * @return void
   */
	 public function __construct($app)
	 {
	 	  parent::__construct($app);
	 	  $this->loadModel('User');
	 }
    
}