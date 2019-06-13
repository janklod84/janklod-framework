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
	 return $this->console->execute(
	 	       $this->signature, 
	 	       $input, 
	 	       $output
	 );
}

/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}