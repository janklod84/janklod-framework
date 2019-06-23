<?php 
namespace JK\Database\Migrations\Commands;



/**
 * Class MigrateCommand
 *
 * @package JK\Database\Migrations\Commands\MigrateCommand
*/ 
class MigrateCommand extends MigrationCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'migrate';
protected $description = [
'This command will migrate all tables to the database.',
'Ex : php console migrate', 
];



/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return $this->migrator->migrate();
}


/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}