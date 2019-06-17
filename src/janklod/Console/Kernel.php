<?php 
namespace JK\Console;


use JK\Http\Contracts\KernelInterface;


/**
 * 
 * @package JK\Http\Kernel
*/ 
class Kernel implements KernelInterface
{



/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface   $request 
 * @return \JK\Http\ResponseInterface $response
*/
public function handle(RequestInterface $request, ResponseInterface $response)
{

}



/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param  mixed $output 
 * @return 
*/
public function terminate(RequestInterface $request, $output)
{

}


}