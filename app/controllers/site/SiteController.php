<?php 
namespace app\controllers\site;


use JK\Routing\Controller;

/**
 * SiteController class [ Base controller frontend part ]
 * @package app\controllers\site\SiteController 
*/
class SiteController extends Controller 
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
