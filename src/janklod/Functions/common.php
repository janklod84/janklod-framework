<?php 

if(!function_exists('sanitize'))
{
     
     /**
      * Sanitize input data
      * @return string
     */
     function sanitize($input='')
     {
     	  return \JK\Helper\Common::sanitize($input);
     }
}