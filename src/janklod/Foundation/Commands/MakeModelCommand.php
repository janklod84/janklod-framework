<?php 
namespace JK\Foundation\Commands;


/**
 * Class MakeModelCommand
 *
 * @package JK\Foundation\Commands\MakeModelCommand
*/ 
class MakeModelCommand extends CustomCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'make:model';
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
	   	   if($model = $this->task->generate('model', $input))
	       {
	       	  // $output->newLine();
	          $output->writeln(
	          	sprintf('Model [ %s ] successfully generated!', $model)
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