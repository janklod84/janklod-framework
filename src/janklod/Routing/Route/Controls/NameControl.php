<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\NameControl 
*/ 
class NameControl
{
	 
/**
* Manage name route
* @param string $callback 
* @param string $name 
* @return string
*/
public static function manage($callback, $name)
{
	 # route filter
	 if(is_string($callback) && $name === null)
	 {
        return $callback;
	 }

	 if($name)
	 {
 	    return $name;
	 }
}


}