<?php 
namespace JK\Http;


use JK\Helper\{
  Sanitize,
  Collection 
};
use Http\Sessions\Session;
use Http\Cookies\Cookie;
use \Config;


/**
 * @package JK\Http\Request 
*/ 
class Request implements RequestInterface
{
      

       /**
        * Constructor
        * @return void
       */
       public function __construct() {}
       

       /**
        * Get base url with or without URI
        * @param bool $uri
        * @return string
       */
       public function baseUrl($uri = false): string
       {
           if(Config::get('app.base_url') && $uri == false)
           {
               return trim(Config::get('app.base_url'), '/');
           }
           return $this->getUrl($uri);
       }

       
       /**
        * Get details url
        * @param string $url 
        * @return array
       */
       public function details($url)
       {
          return parse_url($url);
       }
       
       
       /**
        * Contain all requests by POST, GET, PUT, HEAD, DELETE ...
        * 
        * @param string $key 
        * @return mixed
       */
       public function requests($key = null)
       {
           return $this->sanitize($_REQUEST, $key);
       }


       /**
        * Get item from $_GET request
        * 
        * @param string $key 
        * @return mixed
       */
       public function get($key = null)
       {
           return $this->sanitize($_GET, $key);
       }


       /**
        * Get item from $_POST request
        * 
        * @param string $key 
        * @return mixed
       */
       public function post($key = null)
       {
           return $this->sanitize($_POST, $key);
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
        * @var string $key
        * @return mixed
       */
       public function cookie($key = null)
       {
           return new Cookie($_COOKIE);
       }


       /**
        * Get item from $_SESSION
        * 
        * @param string $key 
        * @return mixed
       */
       public function session($key = null)
       {
           return new Session($_SESSION);
       }



       /**
        * Get data from $_SERVER
        * 
        * @param string $key 
        * @return mixed
       */
       public function server($key = null)
       {
           return $this->collection($_SERVER, $key);
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
         * Return query string
         * @return string
        */
        public function queryString()
        {
            return $this->server('QUERY_STRING');
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
	     * Get the direct ip for user [1]
	     * Get if user uses proxy     [2]
	     * Get the direct ip for user [1]
	     * @return string
	    */
	    public function ip()
	    {
	    	 $ip = $this->server('REMOTE_ADDR'); // [1]

	    	 if($this->server('HTTP_CLIENT_IP')) // [2]
	    	 {
	    	 	  $ip = $this->server('HTTP_CLIENT_IP');

	    	 }elseif($this->server('HTTP_X_FORWARDED_FOR')){

	    	 	  $ip = $this->server('HTTP_X_FORWARDED_FOR');
	    	 }

	    	 return $ip;
	    }



       /**
        * Determine if current scheme is secure
        * @return bool
       */
       public function isSecure()
       {
           return $this->server('HTTPS') == 'on';
       }


       /**
         * Determine if current request is cli
         * @return bool
       */ 
       public function isCli() 
       {
           return $this->server('argc') > 0 
                 || php_sapi_name() === 'cli';
       }


       /**
        * Determine if request method is POST
        * @return bool
      */
      public function isPost(): bool
      {
           return $this->method() === 'POST';
      }


      /**
        * Determine if request method is GET
        * @return bool
      */
      public function isGet(): bool
      {
           return $this->method() === 'GET';
      }


      /**
       * Determine if request method by AJAX
       * @return bool
      */
      public function isAjax(): bool
      {
           return $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
      }


       
     /**
      * Prepare Url
      * @param bool $uri
      * @return string
     */
     private function getUrl($uri = false)
     { 
       	  $scheme = $this->isSecure() ? 'https' : 'http';
       	  $params = [
            $scheme .'://',   
            $this->server('HTTP_HOST'),
            $uri ? $this->server('REQUEST_URI') : ''
       	  ];
       
       	  return implode($params);
     }
       

       /**
        * Retrieve item from repository
        * @param array $data 
        * @param string $key 
        * @return mixed
        */
       private function collection($data, $key)
       {
       	   if(is_null($key))
           {
              return (new Collection($data))->all();
           }
           return (new Collection($data))->get($key);
       }


       /**
        * Sanitize input data
        * 
        * @param array $data
        * @param string $input
        * @return mixed
       */
       public function sanitize($data, $input = null)
       {
            if(is_null($input))
            {
              	$populated = [];

              	foreach($data as $field => $value)
              	{
                      $populated[$field] = trim(Sanitize::input($value));
              	}

              	return $populated;
            }

            return isset($data[$input]) ? trim(Sanitize::input($data[$input])) : '';
       }

       
}