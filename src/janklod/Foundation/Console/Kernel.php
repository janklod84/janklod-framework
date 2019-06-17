<?php 
namespace JK\Foundation\Console;


use JK\Console\IO\{
	InputInterface,
	OutputInterface
};

use JK\Console\Console;


/**
 * 
 * @package JK\Foundation\Console\Kernel
*/ 
class Kernel
{


private $console;

/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
   $this->console = new Console();
}


/**
 * Handler
 * 
 * @param \JK\Console\IO\InputInterface   $input 
 * @return \JK\Console\IO\OutputInterface $output
*/
public function handle(InputInterface $input, OutputInterface $output)
{
     return $this->console->run($input, $output);
}



/**
 * Synthese request and response
 * 
 * @param  InputInterface $input
 * @param  string $status
 * @return void
*/
public function terminate(InputInterface $input, $status)
{
     //
}


}