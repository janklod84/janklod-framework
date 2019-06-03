<?php 
namespace JK\Database\Migrations\Commands;


use JK\Console\CommandInterface;
use JK\Console\Console;

/**
 * @package JK\Database\Migrations\Commands\CustomCommand
*/ 
abstract class CustomCommand implements  CommandInterface 
{

/**
 * @var string $name
*/
protected $name = 'custom:command';
protected $console;


/**
* Constructor
* @return void
*/
public function __construct()
{
     $this->console = new Console();
}

}