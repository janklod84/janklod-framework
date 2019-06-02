<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\PathControl 
*/ 
class PathControl
{
	     

// PATH CONTROL

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
    $path = trim($path, '/');
    if($prefix = OptionControl::getOption('prefix.path'))
    {
         $path = trim($prefix, '/') .'/' . $path;
    }
    return trim($path, '/');
}

}