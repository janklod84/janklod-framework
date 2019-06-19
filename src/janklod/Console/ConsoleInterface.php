<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;



/**
 * Class Console [Excecute command]
 * 
 * @package JK\Console\ConsoleInterface
*/ 
interface ConsoleInterface
{


/**
 * Get console help
 * 
 * @return string
*/
public function help();


/**
 * Excecute command
 * 
 * @param string $compile 
 * @param InputInterface $input 
 * @param OutputInterface $output 
 * @return void
*/
public function execute($compile ='', InputInterface $input, OutputInterface $output);

}