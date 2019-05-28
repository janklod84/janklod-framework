<?php 
use JK\Template\Asset;


if(!function_exists('asset'))
{
     
     /**
      * Render assets by type
      * @param string 
     */
     function asset($type='css')
     {
     	   return Asset::render($type);
     }
}

if(!function_exists('css'))
{
     
     /**
      * Add style
      * @param string $link
     */
     function css($link='')
     {
     	   return Asset::css($link);
     }
}


if(!function_exists('js'))
{
     
     /**
      * Add script
      * @param string $script
     */
     function js($script='')
     {
     	   return Asset::js($script);
     }
}