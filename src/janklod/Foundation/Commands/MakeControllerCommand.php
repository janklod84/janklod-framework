<?php 
namespace JK\Foundation\Commands;


/**
 * Class MakeControllerCommand
 *
 * @package JK\Foundation\Commands\MakeControllerCommand
*/ 
class MakeControllerCommand extends CustomCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'make:controller';
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
 * Execute command
 * 
 * @param JK\Console\IO\InputInterface $input
 * @param JK\Console\IO\OutputInterface $output
 * @return mixed
*/
public function execute($input=null, $output=null)
{
   if($input && $output)
   {
	   if($input->argument(1) === $this->signature) 
	   {
	   	   if($controller = $this->task->generate('controller', $input))
	       {
	       	  // $output->newLine();
	          $output->writeln(
	          	sprintf('Controller [ %s ] successfully generated!', $controller)
	          );
	          $output->writeln('End Execution!');
	       }
	   }
	   
   }
}

/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}