<?php 
namespace app\controllers\admin;

use app\controllers\AdminController;


/**
 * UserController class
 * 
 * @package app\controllers\admin\UserController 
*/ 
class UserController extends AdminController
{
     
  /**
  * Set name of layout want to use
  * @var string $layout
  */
  protected $layout = 'admin';


  /**
  * Do action before action
  * @return void
  */
  public function before() {}

  //public function after(){}

}