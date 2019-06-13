<?php 
namespace JK\Database\Migrations\Commands;


/**
 * @package JK\Database\Migrations\Commands\Rollback
*/ 
class RollbackCommand extends CustomCommand
{


/**
 * @var $name 
*/
protected $name = 'rollback';


/**
 * Execute command
 * @return mixed
*/
public function execute()
{
	   $this->console->execute($this->name, ['No arguments']);
}

/**
 * Undo command
 * @return mixed
*/
public function undo()
{
	   echo __METHOD__."\n";
}

}