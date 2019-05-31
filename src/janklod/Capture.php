<?php 
namespace JK;


/**
 * @package JK\Capture
*/ 
class Capture
{

/**
* Configuration source of application
*/
const SRC = [
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
 'Asset'    => 'JK\\Template\\Components\\Asset',
 'HTML'     => 'JK\\Template\\Components\\HTML', 
 'Config'   => 'JK\\Config\\Config',
 'Url'      => 'JK\\Helper\\Url',
 'DI'       => 'JK\\DI\\Container'
],
'printers' => [
  'RoutingPrinter',
  // 'ViewPrinter',
  // 'DatabasePrinter'
],
'commands' => [
     // Database
     \JK\Database\Migrations\Commands\CreateCommand::class,
     \JK\Database\Migrations\Commands\DeleteCommand::class,
     \JK\Database\Migrations\Commands\UpdateCommand::class,
     \JK\Database\Migrations\Commands\RollbackCommand::class,
     \JK\Database\Migrations\Commands\MigrateCommand::class,
     // Routing
     \JK\Routing\Commands\GenerateController::class,
     // Model
     \JK\Routing\Commands\GenerateModel::class
],
'locator' => [
  'cache_dir' => '/temp/cache/',
  'migration_dir' => '/temp/database/migrations/',
  'log_file' => 'temp/log/error.txt'
]
];
			
}