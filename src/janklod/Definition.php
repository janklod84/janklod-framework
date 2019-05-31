<?php 
namespace JK;


/**
 * @package JK\Definition 
*/ 
class Definition 
{

/**
* Name of Application
* @const string
*/
const APP_NAME = 'JK'; // JanKlod [Жан-Клод]



/**
* Base Configuration of application
*/
const CONFIG = [
'providers' => [
\JK\Http\Facades\RequestProvider::class,
\JK\Http\Facades\ResponseProvider::class,
\JK\Routing\Facades\RouterProvider::class, 
\JK\Loader\Facades\LoaderProvider::class,
\JK\Template\Facades\ViewProvider::class,
\JK\Database\Facades\DatabaseProvider::class,
\JK\Validation\Facades\ValidationProvider::class,
],
'alias' => [
 'Route'    => 'JK\\Routing\\Route\\Route',
 'Asset'    => 'JK\\Template\\Asset',
 'HTML'     => 'JK\\Template\\HTML', 
 'Config'   => 'JK\\Config\\Config',
 'Url'      => 'JK\\Helper\\Url',
 'DI'       => 'JK\\DI\\Container'
],
'commands' => [
   'database' => [
     \JK\Database\Migrations\Commands\CreateCommand::class,
     \JK\Database\Migrations\Commands\DeleteCommand::class,
     \JK\Database\Migrations\Commands\UpdateCommand::class,
     \JK\Database\Migrations\Commands\RollbackCommand::class,
     \JK\Database\Migrations\Commands\MigrateCommand::class,
   ]
]
];
			
}