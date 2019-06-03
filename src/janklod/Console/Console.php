<?php 
namespace JK\Console;

/**
 * @package JK\Console\Console
*/ 
class Console
{


private $commands = []


/**
 * Constructor
 * @param array $commands 
 * @return void
*/
public function __construct($commands = [])
{
     $this->commands = $commands;
}


/**
 * Run console
 * @return void
*/
public function run()
{
   $output = '';
   foreach($this->commands as $command)
   {
      $output = '';
   }

   // return $output;
}

}