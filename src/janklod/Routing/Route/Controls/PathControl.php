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
 * Item maper
 * @param string $path
 * @return mixed
*/
public static function generatePattern($path)
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
    if($prefix = OptionControl::getOption('prefix.path'))
    {
         $path = trim($prefix, '/') .'/' . $path;
    }
    return trim($path, '/');
}

}