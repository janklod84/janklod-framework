<?php 
namespace JK\Http\Contracts;


/**
 * @package JK\Http\Contracts\ResponseInterface 
*/ 
interface ResponseInterface
{
	  
/**
* Send status code, headers, content to server
* @return void
*/
public function send();


}