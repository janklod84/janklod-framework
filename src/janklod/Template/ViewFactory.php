<?php 
namespace JK\Template;



/**
 * @package JK\Template\ViewFactory 
*/ 
abstract class ViewFactory 
{


/**
 * Render view
 * @param string $viewPath
 * @param array $data
 * @return 
*/
 abstract public function render($viewPath='', $data=[]);
}