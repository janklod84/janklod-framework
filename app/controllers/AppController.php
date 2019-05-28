<?php 
namespace app\controllers;


use JK\Routing\Controller;

/**
 * Base controller of application
 * @package app\controllers\AppController 
*/ 
class AppController extends Controller
{
     
     /**
      * Constructor
      * @param \JK\Container\ContainerInterface $app 
      * @return void
     */
     public function __construct($app)
     {
          parent::__construct($app);
     }
}