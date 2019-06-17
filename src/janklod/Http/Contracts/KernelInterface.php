<?php 
namespace JK\Http;


/**
 * Kernel it the core of application
 * @package JK\Http\Kernel 
*/ 
interface KernelInterface
{


/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface   $request 
 * @return \JK\Http\ResponseInterface $response
*/
public function handle(RequestInterface $request, ResponseInterface $response);



/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param  mixed $output 
 * @return output
*/
public function terminate(RequestInterface $request, $output);


}