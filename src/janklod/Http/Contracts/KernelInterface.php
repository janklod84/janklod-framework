<?php 
namespace JK\Http\Contracts;


/**
 * Kernel it the core of application
 * @package JK\Http\Contracts\KernelInterface
*/ 
interface KernelInterface
{



/**
 * Handler
 * 
 * @param \JK\Http\Contracts\ServerRequestInterface $request 
 * @return \JK\Http\Contracts\ResponseInterface $response
*/
public function handle(ServerRequestInterface $request, ResponseInterface $response);



/**
 * Synthese request and response
 * 
 * @param \JK\Http\Contracts\ServerRequestInterface $request 
 * @param  mixed $output 
 * @return mixed
*/
public function terminate(ServerRequestInterface $request, $output);


}