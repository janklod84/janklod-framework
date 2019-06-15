<?php 
namespace JK\Foundation\Generator\Commands;


/**
 * Class DeleteControllerCommand
 *
 * @package JK\Foundation\Generator\Commands\DeleteControllerCommand
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