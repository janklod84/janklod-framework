<?php 
namespace JK\Http;


/**
 * @package JK\Http\RequestInterface 
*/ 
interface RequestInterface
{
	  
	
       /**
        * Contain all requests by POST, GET, PUT, HEAD, DELETE ...
        * 
        * @param string $key 
        * @return mixed
       */
       public function requests($key = null);



       /**
        * Return data from request $_FILES
        * @param string $key 
        * @return array
       */
       public function files($key = null);



       /**
        * Return data from request $_COOKIE
        * @param string $key 
        * @return array
       */
       public function cookies($key = null);
     
        
       /**
        * Return server
        * @param string $key 
        * @return mixed
       */
       public function server($key = null);
}