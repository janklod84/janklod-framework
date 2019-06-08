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
	  if($this->is_cli())
	  {
	  	  $arguments = $_SERVER['argv'];
	  	  if($key)
	  	  {
	  	  	 $arguments = $arguments[$key] ?? '';
	  	  }
	  	  return $arguments;
	  }
}
      
/**
* Give count of parses input
* @return int
*/
public function count()
{
   return $_SERVER['argc'];
}


/**
 * Determine if has mode CLI [ Command Line Interface ]
 * @return bool
*/
public function is_cli()
{
	return (php_sapi_name() != 'cli')
	       || $_SERVER['argc'] > 0;
}

}