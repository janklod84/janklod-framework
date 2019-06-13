<?php 
namespace  JK\Routing;


/**
 * @package JK\Routing\Convertor 
*/ 
class Convertor 
{
      
/**
* Replace pattern
* 
* @param  string    $mask 
* @param  callable  $callable 
* @param  string    $pattern 
* @return string
*/
public static function replace(
string $mask, 
callable $callable, 
string $pattern
)
{
   return preg_replace_callback($mask, $callable, $pattern);
}
}