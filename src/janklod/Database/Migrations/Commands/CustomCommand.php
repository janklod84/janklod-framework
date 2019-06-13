<?php 
namespace JK\Database\Migrations\Commands;


use JK\Console\CommandInterface;
use JK\Console\Receiver\Console;

/**
 * @package JK\Database\Migrations\Commands\CustomCommand
*/ 
abstract class CustomCommand implements  CommandInterface 
{

/**
 * @var string $name
 * @var string $console
*/
protected $name;
protected $console;
// protected $handler = 'make:migration';


/**
* Constructor
* @return void
*/
public function __construct()
{
     $this->console = new Console();
}

/**
 * Execute command
 * @return mixed
*/
abstract public function execute();


/**
 * Undo command
 * @return mixed
*/
abstract public function undo();

}