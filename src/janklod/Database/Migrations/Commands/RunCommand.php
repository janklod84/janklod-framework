<?php 
namespace JK\Database\Migrations\Commands;


/**
 * @package JK\Database\Migrations\Commands\RunCommand
*/ 
class RunCommand extends CustomCommand
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
 * Execute command
 * @return mixed
*/
public function undo()
{
	   echo __METHOD__."\n";
}
}