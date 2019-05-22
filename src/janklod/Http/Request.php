<?php 
namespace JK\Http;


use JK\Http\Sessions\Session;
use JK\Http\Cookies\Cookie;
use JK\Http\Requests\Input;
use JK\Http\Uploads\UploadedFile;

use \Config;


/**
 * @package JK\Http\Request 
*/ 
class Request //implements RequestInterface
{
      
   
 // Type methods
 const METHOD_TYPES = [
   'get', 
   'post', 
   'put', 
   'delete', 
   'head'
];


/**
* Contain all requests by POST, GET, PUT, HEAD, DELETE ...
* 
* @param string $key 
* @return mixed
*/
public function input($key = null)
{
    return (new Input($_REQUEST))
           ->get($key);
}


/**
* Get item from $_GET request
* 
* @param string $key 
* @return mixed
*/
public function get($key = null)
{
   return (new Input($_GET))
          ->get($key);
}


/**
* Get item from $_POST request
* 
* @param string $key 
* @return mixed
*/
public function post($key = null)
{
    return (new Input($_POST))
           ->get($key);
}


/**
* Get item from $_FILES request
* 
* @var string $key
* @return mixed
*/
public function file($key = null)
{
  return new UploadedFile($_FILES);
}


/**
* Get item from $_COOKIE
* 
* @return mixed
*/
public function cookie()
{
   return new Cookie();
}


/**
* Get item from $_SESSION
* 
* @return mixed
*/
public function session()
{
   return new Session();
}



/**
* Get data from $_SERVER
* 
* @param string $key 
* @return mixed
*/
public function server($key = null)
{
   return (new Input($_SERVER))
          ->get($key);
}


/**
* Get current request method POST, GET, ...
* 
* @return string
*/
public function method()
{
	   return $this->server('REQUEST_METHOD');
}


/**
* Get current request uri
* 
* @return string
*/
public function uri()
{
	    return $this->server('REQUEST_URI');
}


/**
* Get host
* 
* @return string
*/
public function host()
{
    return $this->server('HTTP_HOST');
}



 /**
  * Get request cli
  * @return mixed
 */
 public function cli($type = 'argv')
 {
      return $this->server($type);
 }


/**
 * Get User ip
 * @return string
*/
public function ip(){}



/**
 * Determine if has param
 * @param type|string $key 
 * @return string
*/
public function is($key='xxx'): bool
{
       switch($key)
       {
            case 'https':
              return $this->server('HTTPS') == 'on';
            break;
            case 'cli':
              return $this->server('argc') > 0 
              || php_sapi_name() === 'cli';
            break;
            case 'ajax':
              $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
            break;
       }
}


/**
* Determine type of method [ GET, POST, PUT, PUTCH]
* @param string $type 
* @return bool
*/
public function isMethod($type='get'): bool
{
    if(in_array($type, self::METHOD_TYPES))
    {
         return $this->method() === strtoupper($type);
    }
}


/**
* Get Base Url
* @param bool $uri
* @return string
*/
public function url($uri = false)
{
  $url = $this->is('https') ? 'https' : 'http';
  $url .= '://' . $this->host();
  $url .= $uri ? $this->uri() : '';
  return $url;
}

    

       
}