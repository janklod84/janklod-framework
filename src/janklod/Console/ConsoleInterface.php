<?php 
namespace JK\Console;


/**
 * @package JK\Console\ConsoleInterface
*/ 
interface ConsoleInterface
{

/**
 * Get help console
 * @return string
*/
public function help(): string;

/**
 * Execute input
 * @param string $task 
 * @param array $arguments 
 * @return void
*/
public function execute(string $task = '', array $arguments = []): string;

}