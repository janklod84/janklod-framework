<?php 
namespace app\controllers;

use JK\Routing\Controller;


class AdminController  extends Controller
{
  
  /**
   * @var string $layout
  */
  protected  $layout = '';
  

  /**
   * Do something before action 
   *
   * @return 
  */
  public function before()
  {
      // Do action
  }

  
  /**
   * Constructor 
   *
   * @param \JK\Container\ContainerInterface $app 
   * @return void
  */
  public function __construct($app)
  {
      parent::__construct($app);
  }


  /** 
   * Action index 
   *
   * @return mixed 
  */
  public function index()
  {
      // Add your code here ...
  } 


  /**
   * Do something after action 
   *
   * @return 
  */
  public function after()
  {
      // Do action
  }

    
}
