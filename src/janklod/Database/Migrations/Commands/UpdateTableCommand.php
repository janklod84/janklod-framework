<?php 
namespace JK\Database\Migrations\Commands;



/**
 * Class UpdateTableCommand
 *
 * @package JK\Database\Migrations\Commands\UpdateTableCommand
*/ 
class UpdateTableCommand extends MigrationCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'migration:update';
protected $description = [
'This command update specifly table.',
'Ex : php console migration:update users_table.', 
];



/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return $this->migrator->create();
}


/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}