<?php 
namespace JK\Middleware;

use JK\Container\ContainerInterface;


/**
 * @package \JK\Middleware\MiddlewareInterface
*/
interface MiddlewareInterface
{
       
	/**
	* Handle the middleware
	* 
	* @param \JK\Container\ContainerInterface $app
	* @param string $next
	* @return mixed
	*/
	public function handle(ContainerInterface $app, $next);
}