<?php 
namespace JK\Routing;


/**
 * @package JK\Routing\RouterAdapter
*/ 
abstract class RouterAdapter
{
       

/**
 * @var \JK\Routing\RouterInterface $router
*/
private $router;



/**
 * Constructor
 * @param \JK\Routing\RouterInterface $router 
 * @return void
*/
public function __construct(RouterInterface $router)
{
      $this->router = $router;
}


/**
 * Run router 
 * or dispatching 
 * any thing you want
 * inside the child Adapter
*/
abstract public function run();

}