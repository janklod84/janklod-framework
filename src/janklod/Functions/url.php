<?php 
use JK\Http\Url;


if(!function_exists('base_url'))
{
      
      /**
       * Return current base URL
       * @return mixed
      */
      function base_url()
      {
         return Url::base();
      }
}


if(!function_exists('url'))
{
      
      /**
       * Return current url
       * @return mixed
      */
      function url($part='', $params=[])
      {
         return Url::to($part, $params);
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

