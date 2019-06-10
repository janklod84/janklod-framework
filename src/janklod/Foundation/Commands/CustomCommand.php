<?php 
namespace JK\Foundation\Commands;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;
use JK\Foundation\Console\Task;



/**
 * Class generate controller 
 *
 * @package JK\Foundation\Commands\CustomCommand 
*/ 
abstract class CustomCommand extends Command
{

/**
 * @var \JK\Foundation\Console\Task;
 */
protected $task;

/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
     parent::__construct();
     $this->task = new Task();
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
 * @param JK\Console\IO\InputInterface $input
 * @param JK\Console\IO\OutputInterface $output
 * @return mixed
*/
abstract public function execute(
InputInterface $input=null, 
OutputInterface $output=null
);


/**
* Rollback command
* 
* @return mixed
*/
abstract public function undo();

}