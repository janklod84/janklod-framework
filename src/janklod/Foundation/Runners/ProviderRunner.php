<?php 
namespace JK\Foundation\Runners;

/**
 * @package JK\Foundation\Runners\ProviderRunner 
*/ 
class ProviderRunner extends CustomRunner 
{

/**
* Initialize providers
* 
* @return void
*/
public function init()
{
	 foreach(self::get('providers') as $service)
	 {
	   $this->ensureIfClassExist($service);
	   if($provider = new $service($this->app))
	   {
	   	   $this->call([$provider, 'boot']);
		   if(call_user_func([$provider, 'register']) !== false)
		   {
		       self::$initialized['providers'][] = $service;
		   }
		   $this->call([$provider, 'after']);
	   }
	 }
}

/**
 * Make sure class exist
 * @param string $class 
 * @return void
*/
protected function ensureIfClassExist($class, string $message='')
{
   if(!class_exists($class))
   {
        exit(sprintf(
            'class Provider <strong>%s</strong> does not exist!', 
            $class)
        );
   }
       
}

}