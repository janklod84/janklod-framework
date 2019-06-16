<?php 
namespace JK\Routing\Commands;


/**
 * Class MakeControllerCommand
 *
 * @package JK\Routing\Commands\MakeControllerCommand
*/ 
class MakeControllerCommand extends ComponentGenerateCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'make:controller';
protected $description = [
'This command generate new controller.',
'Ex : php console make:controller user.', 
];



/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	return $this->console->makeController();
}

}