<?php 
namespace JK\Console\IO;


/**
 * @package JK\Console\IO\InputArg
*/ 
class InputArg
{
	  
	  public function argument()
	  {
	  	   return $_SERVER['argv'];
	  }
}