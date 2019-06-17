<?php 
namespace JK\Http\Contracts;


/**
 * @package JK\Http\Contracts\RequestHandlerInterface
*/ 
interface RequestHandlerInterface
{

/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @param \JK\Http\ResponseInterface  $response
*/
public function handle(RequestInterface $request): ResponseInterface;


}