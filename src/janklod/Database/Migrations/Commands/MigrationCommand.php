<?php 
namespace JK\Database\Migrations\Commands;


use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;
use JK\Database\Migrations\Migrator;


/**
 * Class MigrationCommand
 *
 * @package JK\Database\Migrations\Commands\MigrationCommand
*/ 
abstract class MigrationCommand implements Command
{
     

/**
 * @var Migrator $migrator
 */
protected $migrator;


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
     $this->migrator = new Migrator($input, $output);
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

}