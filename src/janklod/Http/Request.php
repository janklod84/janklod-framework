<?php 
namespace JK\Http;


use JK\Helper\Sanitize;


/**
 * @package JK\Http\Request 
*/ 
class Request implements RequestInterface
{
      

       /**
        * Constructor
        * @return void
       */
       public function __construct(){}
      


       /**
        * Get base url
        * @return string
       */
       public function baseUrl($uri = true)
       {
           return $this->prepareUrl($uri);
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
        * @param string $key 
        * @return mixed
       */
       public function files($key = null)
       {
           return $this->collection($_FILES, $key);
       }


       /**
        * Get item from $_COOKIE
        * 
        * @param string $key 
        * @return mixed
       */
       public function cookies($key = null)
       {
           return $this->collection($_COOKIE, $key);
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
       public function is_secure()
       {
           return $this->server('HTTPS') == 'on';
       }


       /**
         * Determine if current request is cli
         * @return bool
       */ 
       public function is_cli() 
       {
           return $this->server('argc') > 0 
                 || php_sapi_name() === 'cli';
       }

       
       /**
        * Prepare Url
        * @param string $uri
        * @return string
       */
       private function prepareUrl($uri)
       { 
       	  $http = $this->is_secure() ? 'https' : 'http';
       	  $params = [
            $http .'://',   
            $this->server('HTTP_HOST'),
            !$uri ? '' : $this->server('REQUEST_URI')
       	  ];
       
       	  return implode($params);
       }

       
       /**
        * Add data to collection
        * @param array $data 
        * @return \JK\Helper\Collection
       */
       private function getCollection($data)
       {
       	   return new Repository($data);
       }


       /**
        * Retrieve item from repository
        * @param array $data 
        * @param string $key 
        * @return mixed
        */
       private function collection($data, $key)
       {
       	   return $this->getCollection($data)->get($key);
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