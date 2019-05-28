<?php 
namespace JK\Template;



/**
 * @package JK\Template\ViewFactory 
*/ 
abstract class ViewFactory 
{
      
/**
 * @var \JK\Container\ContainerInterface
*/
protected $app;


/**
 * Constructor
 * @param \JK\Container\ContainerInterface $view 
 * @return void
*/
public function __construct(ContainerInterface $app)
{
     $this->app = $app;
}


/**
 * Render view
 * @param string $viewPath
 * @param array $data
 * @return 
*/
 abstract public function render($viewPath, $data=[]);
}