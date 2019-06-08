<?php 
namespace JK\Http;

use JK\Http\Server\RequestHandlerInterface;

/**
 * Kernel it the core of application
 * @package JK\Http\Kernel 
*/ 
class Kernel implements RequestHandlerInterface
{


/**
 * Constructor
 * @return 
*/
public function __construct()
{

}


/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @return \JK\Http\ResponseInterface
*/
public function handle(
RequestInterface $request
): ResponseInterface
{

}


/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param JK\Http\ResponseInterface $response 
 * @return 
*/
public function terminate(
RequestInterface $request, 
ResponseInterface $response
)
{
  
}


}