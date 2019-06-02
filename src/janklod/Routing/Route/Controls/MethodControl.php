<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\MethodControl 
*/ 
class MethodControl
{
	  
	  /**
	   * Return uppercase param
	   * @param string $method 
	   * @return string
	  */
	  public static function toUpper($method)
	  {
	  	  return strtoupper($method);
	  }
}