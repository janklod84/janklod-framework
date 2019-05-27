<?php 
use JK\Template\View;


if(!function_exists('view'))
{
     
     /**
      * render view
      * @param string $path 
      * @param array $data
      * @return string
     */
     function view($path='', $data=[])
     {
         # exemple path will be loaded dynamically
          $view = new View(__DIR__.'/views/home/index.php');
          $view->setPath($path);
          $view->setData($data);
     	    return $view->render();
     }
}