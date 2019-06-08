<?php 
namespace JK\Http\Server;

use \JK\Http\RequestInterface;
use \JK\Http\ResponseInterface;


/**
 * @package JK\Http\Server\RequestHandlerInterface
*/ 
interface RequestHandlerInterface
{

/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @return mixed
*/
public function handle(RequestInterface $request);


}