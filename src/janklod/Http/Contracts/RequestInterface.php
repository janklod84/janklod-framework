<?php 
namespace JK\Http\Contracts;


/**
 * @package JK\Http\Contracts\RequestInterface 
*/ 
interface RequestInterface extends ServerRequestInterface
{
	  

/**
* Return data from all type request
* 
* @param string $key 
* @return mixed
*/
public function input($key = null);


/**
* Return data from request $_FILES
* @var string $key
* @return array
*/
public function file($key = null);



/**
* Return data from request $_COOKIE
* @return array
*/
public function cookie();



/**
* Return data from request $_SESSION
* @return array
*/
public function session();


/**
 * Request Method
 * 
 * @return string
*/
public function method();


/**
 * Determine type of request
 * 
 * @param string $key 
 * @return bool
*/
public function is($key): bool;
}