<?php 
namespace JK\Http\Commands;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;


/**
 *
 * @package JK\Http\Commands\HttpCommand
*/ 
abstract class HttpCommand extends Command
{


/**
* Constructor
* 
* @param JK\Console\IO\InputInterface $input
* @param JK\Console\IO\OutputInterface $output
* @return void
*/
public function __construct(InputInterface $input=null, OutputInterface $output=null)
{
     parent::__construct($input, $output);
}


/**
 * Configuration command
 * 
 * @return void
*/
public function configure() {}


/**
 * Execute command
 * 
 * @return mixed
*/
abstract public function execute();


/**
* Rollback command
* 
* @return mixed
*/
abstract public function undo();

}