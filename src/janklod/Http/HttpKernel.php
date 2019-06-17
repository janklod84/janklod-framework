<?php 
namespace JK\Http;


use JK\Http\Contracts\{
	KernelInterface,
	ServerRequestInterface, 
	ResponseInterface
};


/**
 * 
 * @package JK\Http\HttpKernel
*/ 
class HttpKernel implements KernelInterface
{



/**
 * Handler
 * 
 * @param \JK\Http\Contracts\ServerRequestInterface $request 
 * @return \JK\Http\Contracts\ResponseInterface $response
*/
public function handle(ServerRequestInterface $request, ResponseInterface $response)
{

}



/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param  mixed $output 
 * @return void
*/
public function terminate(RequestInterface $request, $output)
{

}


}