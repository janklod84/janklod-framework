<?php 
namespace JK\Http;


use JK\Http\Contracts\{
 RequestInterface, 
 ResponseInterface
};


/**
 * 
 * @package JK\Http\HttpKernel
*/ 
class HttpKernel
{


/**
 * Handler
 * 
 * @param \JK\Http\Contracts\RequestInterface $request 
 * @return \JK\Http\Contracts\ResponseInterface $response
*/
public function handle(RequestInterface $request)
{
    // get method 
    // get dispatcher
    // load action
    // return Response;
}


// send headers


/**
 * Send reponse to server
 * 
 * @param  JK\Http\Contracts\RequestInterface  $request 
 * @param  JK\Http\Contracts\ResponseInterface $response
 * @return void
*/
public function terminate(RequestInterface $request, ResponseInterface $response)
{
      // capture les notifications etc
}


}