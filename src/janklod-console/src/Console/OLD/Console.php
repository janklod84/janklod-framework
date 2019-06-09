<?php 
namespace JK\Console;

use JK\Console\IO\InputArg;
use JK\Console\IO\Output;
use JK\Console\Command\Command;

/**
 * Class Console
 * 
 * @package JK\Console\Console
*/ 
class Console
{


/**
 * Constructor
 * @return void
*/
public function __construct()
{
	 $this->commands = new Command();
}


/**
 * Test Previews!
 * 
 * @param object $input
 * @param object $output
 * 
 * @return void
*/
public function execute(InputArg $input=null, Output $output = null)
{
   foreach($this->commands as $key => $command)
   {
   	    if($input->argument() == $key)
   	    {
             $response = $command->execute();
   	    }
   }
   return $output->answer($response);
}

}