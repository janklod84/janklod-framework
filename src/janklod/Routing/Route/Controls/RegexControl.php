<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\RegexControl 
*/ 
class RegexControl
{


/**
 * @var array $regex
*/
private static $regex  = [];


/**
* Add regex
* @param mixed $parameter 
* @param mixed $regex 
*/
public static function add($parameter, $regex = null)
{
   if(is_array($parameter) && is_null($regex))
   {
      foreach($parameter as $index => $exp)
      {
           # recursive
           self::store($index, $exp);
      }

   }else{
       self::$regex[$parameter] = str_replace('(', '(?:', $regex);
   }
}


/**
 * Get Regex
 * @param string $key 
 * @return mixed
*/
public static function get($key)
{
    if(!self::has($key))
    {
    	exit(
    	sprintf('Not Found this <b>[%s]</b> regex', $key)
       );
    }
    return self::$regex[$key];
}


/**
 * Determine if has item Regex
 * @param string $key 
 * @return bool
*/
public static function has($key)
{
    return isset(self::$regex[$key]);
}



/**
  * Return match param
  * @param string $match 
  * @return string 
*/
public static function paramMatch($match)
{
     if(isset(self::$regex[$match[1]]))
     {
          return '('. self::$regex[$match[1]] . ')';
     }
     return '([^/]+)';
}


/**
  * Replace param in path
  * 
  * Ex: $path = ([0-9]+)-([a-z\-0-9]+)
  * 
  * @param string $pattern
  * @return string
*/
 public static function getPattern($pattern)
 {
      return preg_replace_callback(
        '#:([\w]+)#', 
        [new static, 'paramMatch'], 
        $pattern
     );
 }




}