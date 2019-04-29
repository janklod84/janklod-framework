<?php 
namespace JK\Http;
	

/**
 * This class like Request Handler Interface
 * @package JK\Http\Message\Terminate
*/
interface Terminate
{
	  /**
	   * Break Point
       * Handle intermediate beetwen request and response
       * @param RequestInterface $request 
       * @return ResponseInterface
      */
	  public function handle(RequestInterface $request): ResponseInterface;
}