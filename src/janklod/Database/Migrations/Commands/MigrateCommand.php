<?php 
namespace JK\Database\Migrations\Commands;


/**
 * @package JK\Database\Migrations\Commands\MigrateCommand
*/ 
class MigrateCommand extends CustomCommand
{

/**
 * @var $name [ Name command input ]
*/
protected $name = 'migrate';


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