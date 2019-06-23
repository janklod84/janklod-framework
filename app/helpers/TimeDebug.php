<?php 
namespace app\helpers;


/**
 * @package app\helpers\TimeDebug 
*/ 
class TimeDebug
{
   
   /**
    * @return void
   */
   public static function show()
   {
	  $html[] = '<footer class="bg-light py-4 footer mt-auto">';
   	  $html[] = '<div class="container">';
   	  if(defined('JKSTART')): 
           $html[] = 'Страница сгенирована в '. round(1000 * (microtime(true) - JKSTART)) .' ms';
      endif; 
   	  $html[] = '</div>';
      $html[] = '</footer>'; 
	  echo join(PHP_EOL, $html);
   }
      
}