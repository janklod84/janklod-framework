<?php 
namespace JK\Http;


use JK\Http\Sessions\Session;
use JK\Http\Cookies\Cookie;
use JK\Http\Requests\Input;
use JK\Http\Uploads\UploadedFile;
use JK\Http\Contracts\RequestInterface;



/**
 * @package JK\Http\Request 
*/ 
class Request implements RequestInterface
{

/**
 * @const array $globalParams
*/     
private $globalParams = [
  'REQUEST_URI', 
  'PATH_INFO', 
  'QUERY_STRING'
];

/**
 * @const array $ipIndexes
*/
private $ipIndexes = [
  'HTTP_CLIENT_IP',
  'HTTP_X_FORWARDED_FOR',
  'HTTP_X_FORWARDED_FOR'
];

/**
 * @var mixed request body $body
*/
private $body;


/**
 * @var Request $instance  [ Save instance of Request ]
*/
private static $instance;



/**
 * Get instance of request
 * 
 * @return self
*/
public static function capture()
{
    if(is_null(self::$instance))
    {
         self::$instance = new static();
    }
    return self::$instance;
}




/**
* Contain all requests by POST, GET, PUT, HEAD, DELETE ...
* 
* @param string $key 
* @return mixed
*/
public function input($key = null)
{
    return (new Input($_REQUEST))
           ->get($key, true);
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
          ->get($key, true);
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
           ->get($key, true);
}


/**
* Get item from $_FILES request
* 
* @var string $key
* @return mixed
*/
public function file($key=null)
{
   $data = $_FILES;
   if(!is_null($key))
   {
      $data = $_FILES[$key];
   }
   return new UploadedFile($data);
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
* Get User ip [if user uses proxy and so one ...]
* @return string
*/
public function ip()
{
   $ip = $this->server('REMOTE_ADDR'); 
   foreach($this->ipIndexes as $indexIp)
   {
       if($identified = $this->server($indexIp))
       {
           $ip = $identified;
           break;
       }
   }
   return $ip;
}


/**
 * Set body
 * 
 * @param mixed $body
 * @return void
*/
public function setBody($body='')
{
    $this->body = $body;
}


/**
 * Get body
 * 
 * @return mixed
*/
public function body()
{
    return $this->body;
}


/**
 * Determine if has param
 * @param string $key 
 * @return string
*/
public function is($key='xxx'): bool
{
   switch($key)
   {
        case 'secure':
          return $this->server('HTTPS') == 'on'
          || $this->server('SERVER_PORT') == 443;
        break;
        case 'cli':
          return $this->cli('argc') > 0 
          || php_sapi_name() === 'cli';
        break;
        case 'ajax':
          $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
        break;
   }
}


/**
 * Determine if request is Ajax
 * @return bool
*/
public function isAjax()
{
   return $this->is('ajax');
}


/**
* Determine type of method [ GET, POST, PUT, PATCH...]
* @param string $type 
* @return bool
*/
public function isMethod($type='get'): bool
{
   return $this->method() === strtoupper($type);
}



/**
 * Determine if is GET request
 * @return bool
*/
public function isGet()
{
   return $this->isMethod();
}


/**
 * Determine if is POST request
 * @return bool
*/
public function isPost()
{
   return $this->isMethod('post');
}


/**
 * Determine if is PATCH request
 * @return bool
*/
public function isPatch()
{
   return $this->isMethod('patch');
}


/**
 * Determine if is PUT request
 * @return bool
*/
public function isPut()
{
    return $this->isMethod('put');
}


/**
 * Determine if is OPTIONS request
 * @return bool
*/
public function isOptions()
{
    return $this->isMethod('options');
}


/**
 * Determine if is an XHR request
 * @return bool
*/
public function isXhr() {}



/**
* Get Base Url
* @param bool $path [REQUEST_URI, QUERY_STRING, PATH_INFO ...]
* @return string
*/
public function url($path = false)
{
  $url = $this->is('secure') ? 'https' : 'http';
  $url .= '://' . $this->host();
  $url .= $path ?? ''; // may be [ $path = $this->fromGlobals() ]
  return $url;
}


/**
  * Determine current url from global variables
  * 
  * @return string
*/   
public function fromGlobals()
{ 
    $url = '';
    foreach($this->globalParams as $param)
    {
       if($path = $this->server($param))
       {
           $url = $path;
           break;
       }
    }
  
    // parse_url($url);
    if(strpos($url, '?') !== false)
    {
        $url = str_replace('?', '', $url);
    }
    return trim($url, '/');
}



/**
 * Prepare URL
 * 
 * @return string
*/
public function prepareURL()
{
    // TO Implements
}

       
}