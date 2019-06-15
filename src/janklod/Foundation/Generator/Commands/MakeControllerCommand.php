<?php 
namespace JK\Foundation\Generator\Commands;


/**
 * Class MakeControllerCommand
 *
 * @package JK\Foundation\Generator\Commands\MakeControllerCommand
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