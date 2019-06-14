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
'Ex : php console make:model user.', 
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
	 parent::execute($input, $output);
	 return $this->console->execute($this->signature);
}

/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}