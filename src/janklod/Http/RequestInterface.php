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
        * @var string $key
        * @return array
       */
       public function file($key = null);



       /**
        * Return data from request $_COOKIE
        * @var string $key 
        * @return array
       */
       public function cookie($key = null);
     
       
       
       /**
        * Return data from request $_SESSION
        * @var string $key 
        * @return array
       */
       public function session($key = null);


       /**
        * Return server
        * @param string $key 
        * @return mixed
       */
       public function server($key = null);

}