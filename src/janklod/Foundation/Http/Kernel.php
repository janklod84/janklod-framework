<?php 
namespace JK\Foundation\Http;

use JK\Http\Contracts\{
	RequestHandlerInterface,
	RequestInterface, 
	ResponseInterface
};
use JK\Foundation\Application;


/**
 * 
 * @package JK\Foundation\Http\Kernel
*/ 
class Kernel implements RequestHandlerInterface
{


/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
    Application::instance()->bootstrap();
}


/**
 * Handler
 * 
 * @param \JK\Http\Contracts\RequestInterface $request 
 * @return \JK\Http\Contracts\ResponseInterface
*/
public function handle(RequestInterface $request): ResponseInterface
{ 
      if($request->is('cli')) { die('Access denided!'); }
      return Application::instance()->handle($request);
}


/**
 * Terminate processing
 * 
 * @param  JK\Http\Contracts\RequestInterface  $request 
 * @param  JK\Http\Contracts\ResponseInterface $response
 * @return void
*/
public function terminate(RequestInterface $request, ResponseInterface $response)
{
	  if(!$request->is('cli'))
	  { echo $response->getBody(); }
}

}