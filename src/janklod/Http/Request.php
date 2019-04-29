<?php 
namespace JK\Http;

use JK\Http\Message\RequestInterface;


/**
 * @package JK\Http\Request 
*/ 
class Request implements RequestInterface
{
      
      /**
       * @var \JK\Http\Server
      */
      private $server;


       /**
        * Constructor
        * @return void
        */
       public function __construct()
       {
            $this->server = new Server();
       }


     
       /**
         * Determine base URL 
         * Ex: http://framework.loc
         * $uri = false, remove uri
         * 
         * @return string
       */
       public function baseUrl($uri = true)
       {
           return implode($this->urlParams($uri));
       }

       
       /**
        * Prepare Url
        * @return string
       */
       public function prepareUrl(){}


       /**
        * Return server request method
        * @return type
       */
       public function method()
       {
            return $this->server->method();
       }


       /**
        * Return server request uri
        * @return type
       */
       public function uri()
       {
           return $this->server->uri();
       }


       /**
        * Return server request cli
        * @return type
       */
       public function cli($type = 'argv')
       {
           return $this->server->cli($type);
       }



       /**
        * Return query string
        * @param bool $trim 
        * @return string
       */
       public function queryString($trim = false)
       {
           return $this->server->queryString($trim);
       }

       
      
       /**
        * Return server
        * @param string $key 
        * @return mixed
       */
       public function server($key = null)
       {
           return $this->server->get($key);
       }



       /**
        * Return data from request $_REQUEST
        * 
        * @param string $key 
        * @return mixed
       */
       public function fromGlobals($key = null)
       {
            return $this->retrieve('request', $key, true);
       }


       /**
        * Return data from request $_GET
        * 
        * @param string $key 
        * @return mixed
       */
       public function get($key = null)
       {
            return $this->retrieve('get', $key, true);
       }


       /**
        * Return data from request $_POST
        * 
        * @param string $key 
        * @return mixed
       */
       public function post($key = null)
       {
            return $this->retrieve('post', $key, true);
       }

  
      /**
        * Return data from request $_FILES
        * @param string $key 
        * @return array
       */
       public function files($key = null)
       {
           return $this->retrieve('file', $key);
       }


       /**
        * Return data from request $_COOKIE
        * @param string $key 
        * @return array
       */
       public function cookies($key = null)
       {
           return $this->retrieve('cookie', $key);
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
           return $this->server->xmlHttpRequest() === 'XMLHttpRequest';
       }


       /**
        * Determine if current scheme is secure
        * @return bool
        */
       public function is_secure()
       {
           return $this->server->https() == 'on';
       }

       
       /**
         * Determine if current request is cli
         * @return type
       */ 
       public function is_cli() 
       {
           return $this->server->cli('argc') > 0
                  || php_sapi_name() === 'cli';
       }


     /**
      * 
      * @param bool $uri 
      * @return string
     */
     private function urlParams($uri)
     {
         return [
              $this->server->scheme() . '://',
              $this->server->host(),
              !$uri ? '' : $this->server->uri()
        ];
    }


    /**
      * Retrieve item from globals
      * @param string $group 
      * @param string $item 
      * @return mixed
    */
     private function retrieve($group = '', $item = null, $sanitize = false)
     {
          $collection = GlobalCollection::find($group);

          if(is_null($item))
          {
             return $sanitize === true ? $collection->cleanAll() : $collection->all();
          }
          return $sanitize === true ? $collection->cleanItem($item) : $collection->get($item);
    }


}