<?php 
namespace JK\Foundation\Console\Generator;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;

/**
 * Class generate controller 
 *
 * @package JK\Foundation\Console\Generator\GeneratorCommand 
*/ 
abstract class GeneratorCommand extends Command
{


/**
 * @var Generator $console
 */
protected $console;


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
     $this->console = new GeneratorConsole($this->input, $this->output);
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