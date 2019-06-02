<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\PathControl 
*/ 
class PathControl
{

	
/**
 * Sanitize path
 * @param string $path 
 * @return string
*/
public static function sanitize($path)
{
	 return trim($path, '/');
}


/**
 * Give current path not prepared
 * @param string $path 
 * @return string
*/
public static function notPrepared($path)
{
   return self::path($path);
}


/**
 * Generate path pattern
 * @param string $path
 * @return string
*/
public static function pattern($path)
{
    return '#^'. self::path($path) . '$#';
}


/**
 * Map prefixed Path
 * @param string $path 
 * @return string
*/
public static function path($path)
{
    $path = self::sanitize($path);
    if(OptionControl::hasPrefix('path'))
    {
    	 $prefix = OptionControl::prefix('path');
         $path = trim($prefix, '/') .'/' . $path;
    }
    return $path;
}

}