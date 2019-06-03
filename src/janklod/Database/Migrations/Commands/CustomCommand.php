<?php 
namespace JK\Database\Migrations\Commands;


use JK\Console\CommandInterface;
use JK\Console\Console;
use JK\Database\DatabaseManager;

/**
 * @package JK\Database\Migrations\Commands\CustomCommand
*/ 
abstract class CustomCommand implements  CommandInterface 
{

/**
 * @var string $name
*/
protected $name = '';


/**
* Constructor
* @return void
*/
public function __construct()
{

}

}