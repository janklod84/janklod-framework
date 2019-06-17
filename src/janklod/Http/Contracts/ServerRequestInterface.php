<?php 
namespace JK\Http\Contracts;

/**
 * @package JK\Http\Contracts\ServerRequestInterface 
*/ 
interface ServerRequestInterface 
{
	/**
	 * Return params from server
	 * 
	 * @param string $key 
	 * @return void
	 */
	public function server($key=null);
}