<?php 
namespace JK\Views\Components;


/**
 * @package JK\Views\Components\TimeDebug 
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
           $html[] = 'Page generee en '. round(1000 * (microtime(true) - JKSTART)) .' ms';
      endif; 
   	  $html[] = '</div>';
      $html[] = '</footer>'; 
	  echo join(PHP_EOL, $html);
   }
      
}