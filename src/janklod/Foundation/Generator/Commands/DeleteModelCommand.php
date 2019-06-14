<?php 
namespace JK\Foundation\Generator\Commands;


/**
 * Class DeleteModelCommand
 *
 * @package JK\Foundation\Generator\Commands\DeleteModelCommand
*/ 
class DeleteModelCommand extends CustomCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'delete:model';
protected $description = [
'This command delete model.',
'Ex : php console delete:model user.'
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