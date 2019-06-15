<?php 
namespace JK\DI\Contracts;


interface RegistrableInterface 
{

/**
* Get item from container
* @param string $key 
* @return mixed
*/
public function get($key);


/**
* set item to container
* @param string $key 
* @param string $value 
* @return mixed
*/
public function set($key, $value);

}