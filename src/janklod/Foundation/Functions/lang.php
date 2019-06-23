<?php 

if(!function_exists('lang'))
{
     
     /**
      * Get Language
      * 
      * @param string $type
      * @return void
     */
     function lang($code='ru', $translation='')
     {
     	 if($langPath = realpath(ROOT . '/app/lang/'. $code . '/'. $translation.'.php'))
     	 { return require($langPath); }
     }
}
