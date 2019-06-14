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
protected $description = [
'This command generate new model.',
'How used it ? ',
'Do : php <current_file> make:model <name_of_model_you_want_to_generate>',
'Ex : php console make:model user.', 
'it\'ll generate model [ User ]'
];



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