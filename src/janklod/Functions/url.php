<?php 
use JK\Http\Url;


if(!function_exists('base_url'))
{
      
      /**
       * Return current base URL
       * @return string
      */
      function base_url()
      {
           $baseUrl = Config::get('app.base_url');
           if($baseUrl === false)
           {
               return '/'; // or false;
           }
           $url = $baseUrl ? trim($baseUrl, '/') : Url::base();
           $url .= '/';
           return $url;
      }
}


if(!function_exists('url'))
{
      
      /**
       * Ex: http://project.loc/admin/login
       * 
       * Return current url
       * @param string $part
       * @param array $params
       * @return string
      */
      function url($part='', $params=[])
      {
           return base_url() . Url::to($part, $params);
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

