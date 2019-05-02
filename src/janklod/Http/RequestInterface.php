<?php 
namespace JK\Http;


/**
 * @package JK\Http\RequestInterface 
*/ 
interface RequestInterface
{
	  
	
       /**
        * Return data from request $_GET
        * 
        * @param string $key 
        * @return mixed
       */
       public function get($key = null);



       /**
        * Return data from request $_POST
        * 
        * @param string $key 
        * @return mixed
       */
       public function post($key = null);



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