<?php 
namespace JK\Console;


/**
 * @package JK\Console\Console
*/ 
class Console
{
	  
	  public function __construct()
	  {
	  	   echo __METHOD__;
	  }


	  public function execute()
	  {
	  	   // echo __METHOD__;

	  	   $msg = "\n";

	  	   for($i = 1; $i < 5; $i++)
	  	   {
	  	   	  $msg .= 'Bonjour Mr ' . $i . "\n";
	  	   }
	  	   return $msg;
	  }
}