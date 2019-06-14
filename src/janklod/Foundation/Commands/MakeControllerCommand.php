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
protected $description = [
'This command generate new controller.',
'How used it ? ',
'Do : php <current_file> make:controller <name_of_controller_you_want_to_generate>',
'Ex : php console make:controller user.', 
'it\'ll generate controller [ UserController ]',
'you can generate your controller without suffix Controller',
'Ex: php console make:controller Controller_User --no-suffix'
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