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
    return self::mapCallback($callback);
}



/**
 * prepare and map callback
 * @param mixed $callback 
 * @param string $divider '@'
 * @return [\Closure|array]
*/
public static function mapCallback($callback, $divider='@')
{
     if(is_string($callback)) 
     {
         if(strpos($callback, $divider) !== false)
         {
              list($controller, $action) = 
              explode($divider, $callback, 2);
              $controller = self::controller($controller);
              $callback = [
                 'controller' => $controller,
                 'action'     => $action
              ];
         }
     }
     return $callback;
}


/**
* Get controller if with or without prefix
* @param string $controller 
* @return string
*/
public static function controller($controller)
{
   if(OptionControl::hasPrefix('controller'))
   {
       $prefix = OptionControl::prefix('controller');
       $controller = $prefix.'\\'. $controller; 
   }
   return $controller;
}  






}