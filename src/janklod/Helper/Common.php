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
    return htmlentities($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Transform name to CamelCase
 * @param string $name string for transform
 * @return string
*/
public static function upperCamelCase($name) 
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}

  
/**
 * Transform name to lowerCase 
 * Ex: name => Name
 * @param string $name string for transform
 * @return string
*/
public static function lowerCamelCase($name) 
{
   return lcfirst(self::upperCamelCase($name));
}


     
/**
* Replace pattern
* 
* Ex: Common::convertPattern('#{([\w]+)}#', callable, '/url/to/{id}');
* 
* @param  string    $mask 
* @param  callable  $callable 
* @param  string    $pattern 
* @return string
*/
public static function convertPattern(
string $mask, 
callable $callable, 
string $pattern
)
{
   return preg_replace_callback($mask, $callable, $pattern);
}


}