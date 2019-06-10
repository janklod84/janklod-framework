<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\CallBackControl 
*/ 
class CallBackControl
{


/**
* Prepare callback
*
* @param string $callback 
* @return mixed
*/     
public static function prepare($callback)
{
   if(is_string($callback))
   {
       if(OptionControl::hasPrefix('controller'))
       {
             $prefix = OptionControl::prefix('controller');
             $callback = $prefix.'\\'. $callback; 
       }
   }
   return $callback;
}



}