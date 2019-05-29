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


if(!function_exists('redirect'))
{
     
     /**
      * Function for redirect
      * Ex: redirect('/admin/login')
      * @param string $to 
     */
     function redirect($to='/')
     {
         return response()->redirect($to);
     }
}


if(!function_exists('notFound'))
{
     
     /**
      * Redirect to NotFoundController
     */
     function notFound($to='/')
     {
         return redirect(404);
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