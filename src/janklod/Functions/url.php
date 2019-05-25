<?php 
use JK\Helper\Url;


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

