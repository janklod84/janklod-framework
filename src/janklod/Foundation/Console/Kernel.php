<?php 
namespace JK\Foundation\Console;


use JK\Console\IO\{
	InputInterface,
	OutputInterface
};


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
     class_alias('JK\\Foundation\\Console\\Shell', 'Shell');
     $this->console = new Shell();
}


/**
 * Handler
 * 
 * @param \JK\Console\IO\InputInterface   $input 
 * @return \JK\Console\IO\OutputInterface $output
*/
public function handle(InputInterface $input, OutputInterface $output)
{
	 if(php_sapi_name() != 'cli') { die('Restricted'); }
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
	if(!$status)
	{ 
	   exit("\t". $this->console->help() . "\n");
	}
}


}