<?php 
namespace JK\DI\Containers;


interface RegisterInterface 
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


	  /**
	   * Determine if has item in container
	   * @param string $key 
	   * @return mixed
	  */
	  public function has($key);

}