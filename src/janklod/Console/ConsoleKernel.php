<?php 
namespace JK\Console;


use JK\Http\Contracts\{
	KernelInterface,
	ServerRequestInterface, 
	ResponseInterface
};


/**
 * 
 * @package JK\Console\ConsoleKernel
*/ 
class ConsoleKernel implements KernelInterface
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