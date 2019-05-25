<?php 
namespace JK\Helper;


/**
 * @package JK\Helper\Common
*/
class Common
{
       
/**
* Sanitize input data 
* @param string $input
* @return 
*/
public static function sanitize($input)
{
    return htmlentities($parsed, ENT_QUOTES, 'UTF-8');
}
     
}