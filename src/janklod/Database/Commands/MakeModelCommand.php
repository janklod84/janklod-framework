<?php 
namespace JK\Database\Commands;


use JK\Foundation\Console\Generator\GeneratorCommand;

/**
 * Class MakeModelCommand
 *
 * @package JK\Database\Commands\MakeModelCommand
*/ 
class MakeModelCommand extends GeneratorCommand
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