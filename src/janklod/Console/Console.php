<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;

/**
 * Class Console [Excecute command]
 * 
 * @package JK\Console\Console
*/ 
class Console
{

 
/**
 * constructor
 * @param string $file 
 * @return void
*/
public function __construct($file = null)
{
     if($file && $path = realpath($file))
     {
         require($path);
     }
}


/**
 * Execute command
 * @param InputInterface $input
 * @param OutputInterface $output
 * @return 
*/
public function execute(
InputInterface $input, 
OutputInterface $output
)
{
     if(php_sapi_name() != 'cli')
     { die('Restricted'); } 

     $signature = $input->argument(1);
     return Command::get($signature)->execute();
}

}