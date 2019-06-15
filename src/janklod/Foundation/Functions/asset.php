<?php 
use JK\Template\Asset;


if(!function_exists('asset'))
{
     
     /**
      * Render assets by type
      * @param string $type
      * @return void
     */
     function asset($type='css')
     {
     	   Asset::render($type);
     }
}

if(!function_exists('css'))
{
     
     /**
      * Add style
      * @param string $link
      * @return void
     */
     function css($link='')
     {
     	   Asset::css($link);
     }
}


if(!function_exists('js'))
{
     
     /**
      * Add script
      * @param string $script
      * @return void
     */
     function js($script='')
     {
     	   Asset::js($script);
     }
}