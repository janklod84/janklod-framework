<?php 
namespace JK\Foundation\Generator\Commands;


/**
 * Class MakeModelCommand
 *
 * @package JK\Foundation\Generator\Commands\MakeModelCommand
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
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return $this->console->execute($this->signature);
}



/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}