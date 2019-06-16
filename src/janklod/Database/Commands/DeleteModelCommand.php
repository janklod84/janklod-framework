<?php 
namespace JK\Database\Commands;


use JK\Foundation\Console\Generator\GeneratorCommand;

/**
 * Class DeleteModelCommand
 *
 * @package JK\Database\Commands\DeleteModelCommand
*/ 
class DeleteModelCommand extends GeneratorCommand
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
	 return $this->console->deleteModel();
}




/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}