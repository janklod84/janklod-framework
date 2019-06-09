<?php 
namespace JK\Routing\Console\Commands;


/**
 * Class generate controller 
 *
 * @package JK\Routing\Console\Commands\ControllerCommand 
*/ 
class ControllerCommand extends CustomCommand
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
 * Execute command
 * 
 * @param JK\Console\IO\InputInterface $input
 * @param JK\Console\IO\OutputInterface $output
 * @return mixed
*/
public function execute($input=null, $output=null)
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