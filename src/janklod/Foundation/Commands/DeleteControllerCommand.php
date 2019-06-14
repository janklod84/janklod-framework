<?php 
namespace JK\Foundation\Commands;


/**
 * Class DeleteControllerCommand
 *
 * @package JK\Foundation\Commands\DeleteControllerCommand
*/ 
class DeleteControllerCommand extends CustomCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'delete:controller';
protected $description = [
'This command delete controller.',
'Ex : php console delete:controller user',
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