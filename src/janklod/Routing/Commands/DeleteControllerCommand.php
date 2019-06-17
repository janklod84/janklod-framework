<?php 
namespace JK\Routing\Commands;



/**
 * Class DeleteControllerCommand
 *
 * @package JK\Routing\Commands\DeleteControllerCommand
*/ 
class DeleteControllerCommand extends ComponentCommand
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
	 return $this->console->deleteController();
}

}