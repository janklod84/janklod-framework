<?php 
namespace JK\Helper;


// use JK\Http\{Request, Response};
use JK\Http\Request;
use JK\Http\Response;
use JK\Routing\Route;



/**
 * @package \JK\Helper\Url 
*/
class Url
{
      
/**
* Get url from 
* @param string $uri 
* @param array $params 
* @return string
*/
public static function to($uri = '', $params = []): string
{
    if($uri && !empty($params))
    {
       if($namedRoute = Route::url($uri, $params))
       {
            return $namedRoute;
       }

       $uri .= '?'. http_build_query($params);
    }
    
    return $uri;
}


/**
* Return to main page
* @return string
*/
public static function back()
{
   return Response::redirect(self::base());
}


/**
* Base url
* @return string
*/
public static function base()
{
   return call_user_func([new Request, 'url']);
}

}