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
 * 
 * 
 * @param string $url request URL
 * @return string
*/
public static function removeQS($url='') 
{
    if($url)
    {
        $params = explode('&', $url, 2);
        if(strpos($params[0], '=') === false)
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


/**
* Get Int
* 
* @param string $name 
* @param ?int|null $default 
* @return int
*/  
public static function getInt(string $name, ?int $default = null): ?int
{
  if(!isset($_GET[$name])) { return $default; }
    if($_GET[$name] === '0') { return 0; }

  if(!filter_var($_GET[$name], FILTER_VALIDATE_INT))
  {
     throw new \Exception(
            sprintf("This param [ %s ] in url is not integer", $name)
     ); 
  }

  return (int)$_GET[$name];
}


/**
* Get Positive Int
* 
* @param string $name 
* @param ?int|null $default 
* @return int
*/  
public static function getPositiveInt(string $name, ?int $default = null): ?int
{
    $param = self::getInt($name, $default);
    if($param !== null && $param <= 0)
    {
       throw new \Exception(
            sprintf("This param [ %s ] in url is not positif integer", $name)
     ); 
    }

    return $param;

}
}