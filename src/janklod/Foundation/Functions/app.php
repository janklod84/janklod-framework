<?php 

if(!function_exists('app')) 
{ 
     
	/**
	 * Get the application instance
	 * @return \JK\Application
	*/
	function app()
	{
	   return \JK\Application::instance(ROOT);
	}
}


if(!function_exists('container')) 
{ 
     
	/**
	 * Get current application container
	 * @return \JK\Container\ContainerInterface
	*/
	function container()
	{
	   return app()->getContainer();
	}
}