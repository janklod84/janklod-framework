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