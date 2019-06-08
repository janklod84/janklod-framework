<?php 
namespace JK\Http\Server;

use \JK\Http\RequestInterface;
use \JK\Http\ResponseInterface;


/**
 * @package JK\Http\Server\ServerInterface
*/ 
interface ServerInterface
{

/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface  $request 
 * @return \JK\Http\ResponseInterface 
*/
public function handle(
RequestInterface $request
):? ResponseInterface;


public function terminate(
RequestInterface $request, 
ResponseInterface $response
);

}