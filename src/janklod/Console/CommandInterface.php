<?php 
namespace JK\Console;


use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface; 

/**
 * @package JK\Console\CommandInterface
*/ 
interface CommandInterface 
{

/**
 * Execute command
 * @param JK\Console\IO\InputInterface $input
 * @param JK\Console\IO\OutputInterface $output
 * @return mixed
*/
public function execute(
InputInterface $input = null, 
OutputInterface $output = null
);

/**
* Roolback command
* @return void
*/
public function undo();

}