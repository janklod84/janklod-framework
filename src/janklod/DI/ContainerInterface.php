<?php 
namespace JK\DI;


/**
 * @package JK\DI\ContainerInterface 
*/ 
interface ContainerInterface 
{
       
/**
* Set item in container
* @param string $key 
* @param mixed $resolver
* @return void
*/
public function set($key, $resolver);


/**
* Determine if has key in container
* @param string $key 
* @return bool
*/
public function has($key): bool;


/**
* Get item from container
* @param string $key 
* @return mixed
*/
public function get($key);


/**
* Remove item from container
* @param string $key 
* @return void
*/
public function remove($key);
}
