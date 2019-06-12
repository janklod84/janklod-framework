<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\PathControl 
*/ 
class PathControl
{


/**
 * Generate path pattern
 * @param string $path
 * @return string
*/
public static function pattern($path)
{
    return '#^'. self::path($path) . '$#i';
}


/**
 * Map prefixed Path
 * 
 * @param string $path 
 * @return string
*/
private static function path($path)
{
    $path = self::sanitize($path);
    if(OptionControl::hasPrefix('path'))
    {
    	 $prefix = OptionControl::prefix('path');
         $path = self::sanitize($prefix) .'/' . $path;
    }
    return $path;
}


/**
 * Trainling Slahes
 * 
 * @param string $path 
 * @return string
*/
private static function sanitize($path)
{
     return trim($path, '/');
}

}