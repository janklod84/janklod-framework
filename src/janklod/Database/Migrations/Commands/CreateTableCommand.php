<?php 
namespace JK\Database\Migrations\Commands;



/**
 * Class CreateTableCommand
 *
 * @package JK\Database\Migrations\Commands\CreateTableCommand
*/ 
class CreateTableCommand extends MigrationCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'migration:create {name_table}';
protected $description = [
'This command create new table.',
'Ex : php console migration:create users_table.', 
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