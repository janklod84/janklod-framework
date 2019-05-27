<?php 
use JK\Http\Response;



if(!function_exists('response'))
{
     
     /**
      * Response method
      * @param string $content 
      * @param int $status 
      * @param array $headers 
      * @return \JK\Http\Response 
     */
     function response($content='', $status = 200, $headers = [])
     {
     	  return new Response($content, $status, $headers);
     }
}


if(!function_exists('send'))
{
     
     /**
      * Method for sending headers and content ...
     */
     function send()
     {
         return response()->send();
     }
}