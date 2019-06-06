<?php 
namespace JK\Database\Migrations\Receiver;

use JK\Console\ConsoleInterface;
use JK\Console\IO\Output;
use JK\Console\IO\InputArg;


/**
 * @package JK\Database\Migrations\Receiver\Console 
*/ 
class Console implements ConsoleInterface
{

/**
 * Help message
 * @return string
*/
public function help(): string
{
    return '';
}


/**
 * Excecute command
 * @param string $task 
 * @param array $arguments 
 * @return string
*/
public function execute(string $task = '', array $arguments = []): string
{
   
}

}