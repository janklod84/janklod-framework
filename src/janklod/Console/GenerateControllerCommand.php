<?php 
namespace JK\Console;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;


/**
 * Class generate controller 
 *
 * @package JK\Console\Commands\GenerateControllerCommand 
*/ 
class GenerateControllerCommand extends Command
{
     
     /**
 * @var string $argument      [ Signature of command   ]
 * @var string $description   [ Description of command ]
*/
protected $argument    = 'make:controller';
protected $description = 'description of command';


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
 * Add argument
 * 
 * @param string $argument 
 * @return void
*/
public function addArgument($argument='')
{
	  $this->argument = $argument;
	  return $this;
}


/**
 * Add description
 * 
 * @param string $description
 * @return self
*/
public function addDescription($description='')
{
   $this->description = $description;
   return $this;
}


/**
 * Get argument
 * 
 * @return string
*/
public function argument()
{
    return $this->argument;
}


/**
 * Get description
 * 
 * @return string
*/
public function description()
{
    return $this->description;
}


/**
 * Configuration command
 * 
 * @return void
*/
public function configure(){}


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
	
   echo 'Argument : '. $this->argument. "\n";
   $output->writeln('Controller successfully generated!');
	 
   // die('Controller successfully generated!');
}


/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}