<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\InputArgv 
*/ 
class InputArgv implements InputInterface
{

/**
 * Get input argument from console
 * @param null|string $key 
 * @return mixed
*/
public function argument($key=null)
{   
   $arguments = $this->server('argv');
   if($this->is_cli() && !is_null($key))
   {
      return trim($arguments[$key]) ?? null;
   }
   return $arguments;
}
      
/**
* Give count of parses input
* 
* @return int
*/
public function account()
{
   return $this->server('argc');
}


/**
 * Determine if has mode CLI [ Command Line Interface ]
 * @return bool
*/
public function is_cli()
{
	return (php_sapi_name() != 'cli')
	       || $this->server('argc') > 0;
}


/**
 * Server arguments
 * 
 * @param string $key 
 * @return mixed
*/
public function server($key=null)
{
   $server = $_SERVER;
   if(!is_null($key))
   {
   	   return $server[$key] ?? null;
   }
   return $server;
}

}