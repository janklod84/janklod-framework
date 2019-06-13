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
 * Excecute command
 * 
 * @param string $signature 
 * @param InputInterface $input 
 * @param OutputInterface $output 
 * @return void
*/
public function execute(
$signature='', 
InputInterface $input, 
OutputInterface $output
);

}