<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\CallBackControl 
*/ 
class CallBackControl
{


/**
* Manage callback
* @param string $callback 
* @return mixed
*/     
public static function manage($callback)
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