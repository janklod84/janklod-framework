<?php 
use JK\Http\Request;


if(!function_exists('request'))
{
     
     /**
      * Request
      * @return \JK\Http\Request
     */
     function request()
     {
     	  return new Request();
     }
}


if(!function_exists('server'))
{
     
     /**
      * Request
      * @return \JK\Http\Requests\Input
     */
     function server()
     {
     	  return request()->server();
     }
}


if(!function_exists('input'))
{
     
     /**
      * Input
      * @return \JK\Http\Requests\Input
     */
     function input($key='')
     {
     	  return request()->input($key);
     }
}


if(!function_exists('post'))
{
     
     /**
      * Input
      * @return \JK\Http\Requests\Input
     */
     function post($key='')
     {
     	  return request()->post($key);
     }
}


if(!function_exists('get'))
{
     
     /**
      * Input
      * @return \JK\Http\Requests\Input
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
      * @return \JK\Http\Uploads\UploadedFile
     */
     function files()
     {
     	  return request()->files();
     }
}


