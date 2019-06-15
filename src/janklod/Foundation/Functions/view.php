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



// TO FIX
if(!function_exists('partial'))
{
     
     /**
      * require partials
      * directory from view config: partial = 'partials'
      * Ex: <?php partial('menu', 'layouts'); ?> 
      * will give   ../app/views/layouts/partials/menu.php 
      * 
      * if you remove partial you must to write full path ex: partials/menu
      * @param string $path 
      * @return string
     */
     function partial($path='')
     {   
         $viewObj = app()->view;
         $viewObj->partial($path);
     }
}