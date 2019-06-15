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
 * Construct
 * 
 * @param ?InputInterface|null $input 
 * @param ?OutputInterface|null $output 
 * @return void
*/
public function __construct(InputInterface $input = null, OutputInterface $output = null);


/**
 * Execute command
 * 
 * 
 * @return mixed
*/
public function execute();


/**
* Rollback command
* 
* @return mixed
*/
public function undo();

}