<?php 
namespace JK\Routing;



/**
 * @package JK\Routing\RouteDispatched
*/ 
class RouteDispatched
{
       
     /**
 * Map matched route 
 * @param string $method
 * @return 
*/
public function dispatch()
{
      if(empty($this->routes))
      {
          exit('Not Found routes!');
      }

      foreach($this->routes as $route)
      {
           if($route->match($this->url))
           {
                return new Dispatcher($route);
           }
      }

      exit('No matches routes!');
}

}