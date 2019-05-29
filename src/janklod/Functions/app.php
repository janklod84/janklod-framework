<?php 
namespace JK\Application;


if(!function_exists('app')) 
{ 
     
	/**
	 * Get the application instance
	 * @return \JK\Application
	*/
	function app()
	{
	   return Application::instance();
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