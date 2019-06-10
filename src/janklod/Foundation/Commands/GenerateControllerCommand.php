<?php 
namespace JK\Foundation\Commands;


/**
 * Class generate controller 
 *
 * @package JK\Foundation\Commands\GenerateControllerCommand
*/ 
class GenerateControllerCommand extends CustomCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
// protected $signature  = 'make:controller {--option}';
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
 * @param \JK\Console\IO\InputInterface $input 
*/
/*
public function options($input)
{
	if(!is_null($input))
	{
		$argument = $input->argument(1);
		if($input->account() > 1)
		{
			$argument = str_replace(
			 ['{--option}'], [$input->argument(2)], $this->signature
		   );
		}
		return $argument;
	}
}
*/


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