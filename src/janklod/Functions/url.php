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


if(!function_exists('back'))
{
      
      /**
       * Return current base URL
       * @return mixed
      */
      function back()
      {
         return Url::base();
      }
}

