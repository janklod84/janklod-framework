<?php 
namespace app\controllers\admin;


use JK\Routing\Controller;

/**
 * Base controller of admin
 * @package app\controllers\admin\AdminController 
*/ 
class AdminController extends Controller
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