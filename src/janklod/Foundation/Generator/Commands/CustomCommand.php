<?php 
namespace JK\Foundation\Generator\Commands;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;
use JK\Foundation\Generator\Generator;



/**
 * Class generate controller 
 *
 * @package JK\Foundation\Generator\Commands\CustomCommand 
*/ 
abstract class CustomCommand extends Command
{

/**
 * @var FileConsole;
 */
protected $console;

/**
 * Constructor
 * 
 * @return void
*/
public function __construct()
{
     parent::__construct();
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
public function execute(
InputInterface $input=null, 
OutputInterface $output=null
)
{
	$this->console = new Generator($input, $output);
}


/**
* Rollback command
* 
* @return mixed
*/
abstract public function undo();

}