<?php 

if(!function_exists('app')) 
{ 
     
	/**
	 * Get the application instance
	 * @return \JK\Foundation\App
	*/
	function app()
	{
	   return \JK\Foundation\App::instance(ROOT);
	}
}


if(!function_exists('notify'))
{

	/**
	 * Notification
	 * 
	 * @return void
	*/
	function notify()
	{
	    $debogger = \JK\Foundation\App::instance()->notify();
	    $debogger->output(\Config::get('app.debug'));
	}

}

if(!function_exists('title'))
{
	/**
	 * Get title
	 * 
	 * @param string $title 
	 * @param string $default 
	 * @return string
	*/
	function title($title, $default='')
	{
		 return isset($title) ? $title : $default;
	}
}


if(!function_exists('app_name'))
{
   /**
    * Get application name
    * 
    * @return string
   */
   function app_name()
   {
   	   return Config::get('app.name');
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