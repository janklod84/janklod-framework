<?php 
namespace JK\View;



/**
 * @package JK\View\ViewFactory 
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