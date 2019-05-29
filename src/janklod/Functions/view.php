<?php 
use JK\Template\View;

if(!function_exists('view'))
{
     
     /**
      * render view
      * @param string $view 
      * @param array $data
      * @return string
     */
     function view($view='', $data=[])
     {
          $viewObj = app()->view;
          $viewObj->setView($view);
          $viewObj->setData($data);
          $viewObj->render();
     }
}


if(!function_exists('partial'))
{
     
     /**
      * require partials
      * @param string $path 
      * @return string
     */
     function partial($path='')
     {   
          $path = $path ?: 'partials/'. $path;
          $file = sprintf('%s.php', $path);
          include($file);
     }
}