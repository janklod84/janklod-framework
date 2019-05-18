<?php 
namespace JK\Http;


/**
 * @package JK\Http\ResponseInterface 
*/ 
interface ResponseInterface
{
	  
	  /**
	   * Send status code, headers, content to server
	   * @return void
	  */
	  public function send();
}