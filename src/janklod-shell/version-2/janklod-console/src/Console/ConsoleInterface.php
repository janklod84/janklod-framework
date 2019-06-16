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
 * Run and execute commands
 * 
 * @param InputInterface $input
 * @param OutputInterface $output
 * 
 * @return mixed
*/
public function run(
InputInterface $input, 
OutputInterface $output
);

}