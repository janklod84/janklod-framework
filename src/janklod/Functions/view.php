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