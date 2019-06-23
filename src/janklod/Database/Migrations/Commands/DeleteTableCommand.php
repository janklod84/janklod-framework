<?php 
namespace JK\Database\Migrations\Commands;



/**
 * Class DeleteTableCommand
 *
 * @package JK\Database\Migrations\Commands\DeleteTableCommand
*/ 
class DeleteTableCommand extends Command
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'migration:delete';
protected $description = [
'This command delete specifly table.',
'Ex : php console migration:delete users_table.', 
];



/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return $this->migrator->delete();
}


/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}