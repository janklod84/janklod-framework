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
     public function view($path='', $data=[])
     {
     	     // return (new View())->render($path, $data);
     }
}