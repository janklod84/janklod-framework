<?php 
use JK\Http\Request;


if(!function_exists('request'))
{
     
     /**
      * Request
      * 
      * @return \JK\Http\Request
     */
     function request()
     {
     	  return app()->request; // new Request();
     }
}


if(!function_exists('server'))
{
     
     /**
      * Server
      * 
      * @param string $key
      * @return mixed
     */
     function server($key='')
     {
     	  return request()->server($key);
     }
}


if(!function_exists('input'))
{
     
     /**
      * Input
      * 
      * @param string $key
      * @return mixed
     */
     function input($key='')
     {
     	  return request()->input($key);
     }
}


if(!function_exists('post'))
{
     
     /**
      * Post
      * 
      * @param string $key
      * @return mixed
     */
     function post($key='')
     {
     	  return request()->post($key);
     }
}


if(!function_exists('get'))
{
     
     /**
      * Get
      * 
      * @param string $Key
      * @return mixed
     */
     function get($key='')
     {
     	  return request()->get($key);
     }
}



if(!function_exists('session'))
{
     
     /**
      * Session
      * @return \JK\Http\Sessions\Session
     */
     function session()
     {
     	  return request()->session();
     }
}


if(!function_exists('cookie'))
{
     
     /**
      * Cookie
      * @return \JK\Http\Cookies\Cookie
     */
     function cookie()
     {
     	  return request()->cookie();
     }
}


if(!function_exists('files'))
{
     
     /**
      * UploadedFile
      * 
      * @param string $key
      * @return \JK\Http\Uploads\UploadedFile
     */
     function files($key='')
     {
     	  return request()->files($key);
     }
}


