<?php 
use JK\Http\Url;


if(!function_exists('base_url'))
{
      
/**
 * Base URL 
 * Ex: http://project.loc/admin/login
 * 
 * @param  string $path 
 * @param  array  $params 
 * @return void
 */
function base_url($path='', $params = [])
{
     $baseUrl = Config::get('app.base_url');
     if($baseUrl === false)
     {
         return '/'; // or false;
     }
     $base = $baseUrl ? trim($baseUrl, '/') : Url::base();
     $base .= '/'. Url::to($path, $params);
     return $base;
}

}



if(!function_exists('back'))
{
      
      /**
       * Redirect to base URL
       * @return mixed
      */
      function back()
      {
          return Url::back();
      }
}

