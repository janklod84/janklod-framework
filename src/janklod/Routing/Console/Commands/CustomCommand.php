<?php 
namespace JK\Routing\Console\Commands;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;



/**
 * Class generate controller 
 *
 * @package JK\Routing\Console\Commands\CustomCommand 
*/ 
abstract class CustomCommand extends Command
{

/**
 * @var \JK\Routing\Console\TaskGenerator
 */
protected $generator;

/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
     parent::__construct();
     // $this->generator = new TaskGenerator();
}



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