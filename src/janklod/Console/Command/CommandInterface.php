<?php 
namespace JK\Console\Command;


/**
 * @package JK\Console\Command\CommandInterface
*/ 
interface CommandInterface 
{

/**
* Execute command
* @return mixed
*/
public function execute();


/**
* Roolback command
* @return void
*/
public function undo();
}