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
* @param string $divider
* @return string
*/     
public static function manage($callback, $divider='@')
{
  if(is_string($callback))
  {
        return self::mapCallback($callback, $divider);
  }
  return $callback;
}



/**
 * prepare and map callback
 * @param mixed $callback 
 * @param string $divider '@'
 * @return 
*/
public static function mapCallback($callback, $divider='@')
{
     if(strpos($callback, $divider) !== false)
     {
          list($controller, $action) = 
          explode($divider, $callback, 2);
          $controller = self::controller($controller);
          return [
             'controller' => $controller,
             'action'     => $action
          ];
     }
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