<?php 
namespace JK\Console\IO;

/**
 * @package JK\Console\IO\InputArgv 
*/ 
class ArgvInput implements InputInterface
{
      public function argument($key=null)
	  {
	  	  if(isset($_SERVER['argv']))
	  	  {
	  	  	  $arguments = $_SERVER['argv'];
	  	  	  if($key)
	  	  	  {
	  	  	  	 $arguments = $arguments[$key] ?? '';
	  	  	  }
	  	  	  return $arguments;
	  	  }
	  }
}