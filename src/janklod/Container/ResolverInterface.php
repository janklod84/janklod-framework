<?php 
namespace JK\Container;


interface ResolverInterface 
{

	     /**
		   * Get item from container
		   * @param string $key 
		   * @return mixed
		  */
		  public function resolve($key);

}