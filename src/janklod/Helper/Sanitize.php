<?php 
namespace JK\Helper;


/**
 * @package JK\Helper\Sanitize
*/
class Sanitize
{
       
       /**
        * Sanitize input data 
        * @param string $input 
        * @return 
       */
	   public static function input($data)
	   {
           return htmlentities($data, ENT_QUOTES, 'UTF-8');
	   }
}