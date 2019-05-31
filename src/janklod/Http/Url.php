<?php 
namespace JK\Http;



/**
 * @package \JK\Http\Url
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
       if($namedRoute = \Route::url($uri, $params))
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


/**
 * Remove Query String
 * Return string without GET parameters
 * @param string $url request URL
 * @return string
*/
public static function removeQS($url='') 
{
    if($url)
    {
        $params = explode('&', $url, 2);
        if(false === strpos($params[0], '='))
        {
            return rtrim($params[0], '/');
        }else{
            return '';
        }
    }
}


/**
 * Get cleaner URI
 * @return string
*/
public static function prepareUri()
{
    $uri = call_user_func([new Request, 'uri']);
    return trim(parse_url($uri, PHP_URL_PATH), '/');
}



}