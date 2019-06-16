<?php 
namespace JK\Routing\Commands;


/**
 * Class MakeControllerCommand
 *
 * @package JK\Routing\Commands\MakeControllerCommand
*/ 
class MakeControllerCommand extends GenerateComponentCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'make:controller';
protected $description = [
'This command generate new controller.',
'Ex : php console make:controller user.',
'Ex : php console make:controller home --path:backend [ backend name folder ]',
'For this case it\'ll be generated app\\controllers\\backend\\HomeController'
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