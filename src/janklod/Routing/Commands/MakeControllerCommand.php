<?php 
namespace JK\Routing\Commands;

use JK\Foundation\Console\Generator\GeneratorCommand;

/**
 * Class MakeControllerCommand
 *
 * @package JK\Routing\Commands\MakeControllerCommand
*/ 
class MakeControllerCommand extends GeneratorCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'make:controller';
protected $description = [
'This command generate new controller.',
'Ex : php console make:controller user.', 
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