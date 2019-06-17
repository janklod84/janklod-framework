<?php 
namespace JK\Http\Commands;


/**
 * Class ServerControllerCommand
 *
 * @package JK\Http\Commands\ServerCommand
*/ 
class ServerCommand extends HttpCommand
{
     

/**
 * @var string $signature    [ Signature of command   ]
 * @var string $description  [ Description of command ]
*/
protected $signature   = 'server';
protected $description = [
'Run server : ',
'Ex: php console server',
'This command run server on the port <8000>',
'Lunch on your browser http://localhost:8000',
'Stop server [ Ctrl+C ]'
];


/**
 * Execute command
 * 
 * @return mixed
*/
public function execute()
{
	 return exec(
	 'php -S localhost:8000 -t public -d display_errors=1 server.php'
	 );
}



/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}

}