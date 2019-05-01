<?php 
namespace JK\Helper;


/**
 * @package JK\Helper\Sanitize
*/
class Sanitize
{
       
     /**
      * Sanitize data 
      * @param string $parsed
      * @return 
     */
	   public static function input($parsed)
	   {
          return htmlentities($parsed, ENT_QUOTES, 'UTF-8');
	   }
	     
}