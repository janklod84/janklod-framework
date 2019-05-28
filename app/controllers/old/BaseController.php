<?php 
namespace app\controllers;

use JK\Routing\Controller;


/**
 * Base controller Front part of application
 * @package app\controllers\BaseController 
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
     

     
   /**
     * Load model
     * @var string $name [ Name of Model ]
     * @return object
   */
	 protected function loadModel($name='')
	 {
         $folder = ucfirst($name);
	 	     $manager = sprintf('\\app\\models\\%s\\%sManager', $folder, $name);
	 	     $named = strtolower($name);
         $this->{$named} = new $manager();
	 }


    /**
     * Load model
     * @var string $name [ Name of Model ]
     * @return object
   */
   protected function loadManager($name='')
   {
         $model = sprintf('\\app\\models\\Entity\\%s', $name);
         $manager = sprintf('\\app\\models\\Manager\\%sManager', $name);
         $named = strtolower($name);
         $modelObj = new $model();
         $this->{$named} = new $manager($modelObj);
   }
}