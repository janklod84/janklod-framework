<?php 
namespace JK\Database\Migrations\Commands;



/**
 * Class RollbackCommand
 *
 * @package JK\Database\Migrations\Commands\RollbackCommand
*/ 
class RollbackCommand extends MigrationCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'migration:rollback';
protected $description = [
'This command will remove all created tables.',
'Ex : php console migration:rollback', 
];



/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return $this->migrator->rollback();
}


/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}