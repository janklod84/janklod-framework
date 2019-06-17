<?php 
namespace JK\Console;


/**
 * 
 * @package JK\Console\ConsoleKernel
*/ 
class ConsoleKernel
{



/**
 * Handler
 * 
 * @param \JK\Console\IO\InputInterface   $input 
 * @return \JK\Console\IO\OutputInterface $output
*/
public function handle($input, $output)
{
    // return 'status';
}



/**
 * Synthese request and response
 * 
 * @param  InputInterface $input
 * @param  string $status
 * @return void
*/
public function terminate($input, $status)
{

}


}