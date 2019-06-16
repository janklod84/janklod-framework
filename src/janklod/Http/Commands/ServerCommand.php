<?php 
namespace JK\Http\Commands;


/**
 * Class MakeControllerCommand
 *
 * @package JK\Http\Commands\ServerCommand
*/ 
class ServerCommand extends HttpCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'server';
protected $description = [
'Start server : ',
'Ex: php console server'
];


/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 // return $this->console->execute($this->signature);
	 die($this->signature);
}



/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}