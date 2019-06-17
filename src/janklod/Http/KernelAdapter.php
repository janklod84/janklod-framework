<?php 
namespace JK\Http;


/**
 * Kernel
 * 
 * @package JK\Http\KernelAdapter
*/ 
class KernelAdapter
{


/**
 * @var KernelInterface $kernel
*/
private $kernel;



/**
 * Constructor
 * 
 * @param KernelInterface $kernel
 * @return void
*/
public function __construct(KernelInterface $kernel)
{
     $this->kernel = $kernel;
}


/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @return \JK\Http\ResponseInterface
*/
public function handle(RequestInterface $request): ResponseInterface
{
      return $this->kernel->handle($request);
}


/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param JK\Http\ResponseInterface $response 
 * @return 
*/
public function terminate(RequestInterface $request, ResponseInterface $response)
{
     return $this->kernel->terminate($request, $response);
}


}