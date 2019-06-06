<?php 
namespace JK\Console;

use JK\Console\IO\InputArg;
use JK\Console\IO\Output;


/**
 * Class Console
 * 
 * @package JK\Console\Console
*/ 
class Console
{


// private $commands = []


/**
 * Constructor
 * @param array $commands 
 * @return void
*/
public function __construct($commands = [])
{
     // $this->commands = $commands;
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