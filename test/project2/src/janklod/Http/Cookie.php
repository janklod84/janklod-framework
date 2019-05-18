<?php 
namespace JK\Http;


/**
 * @package JK\Http\Cookie 
*/ 
class Cookie 
{

/**
* @var array $cookies
*/
private $cookies = [];


/**
* Constructor
* @param array $cookies 
* @return void
*/
public function __construct($cookies = [])
{
   $this->cookies = $cookies;
}


/**
* Set cookies
* @param string $name 
* @param mixed $value 
* @param int $times 
* @param string $domain 
* @param bool $httpOnly 
* @return void
*/
public function set(
$name, 
$value, 
$times = 3600, 
$domain = '/', 
$httpOnly = false)
{

}


/**
* Determine if has item in $_COOKIE
* @param string $key 
* @return bool
*/
public function has($key): bool
{

}


/**
* Get item from $_COOKIE
* @param string $key 
* @return mixed
*/
public function get($key)
{

}


/**
* Get all cookies from $_COOKIE
* @return array
*/
public function all()
{
	  
}
}