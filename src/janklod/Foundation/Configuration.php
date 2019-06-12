<?php 
namespace JK\Foundation;


/**
 * @package JK\Foundation\Configuration
*/ 
class Configuration
{


const MODULE_DIR = [
   'controller' => 'app/controllers', 
];

/**
* Base Configuration of application
*/
const SRC = [
'providers' => [
\JK\Http\Facades\ResponseProvider::class,
\JK\Routing\Facades\RouterProvider::class, 
\JK\Loader\Facades\LoaderProvider::class,
\JK\View\Facades\AssetProvider::class,
\JK\View\Facades\ViewProvider::class,
\JK\Security\Facades\AuthenticateProvider::class,
\JK\Database\Facades\DatabaseProvider::class,
\JK\Validation\Facades\ValidationProvider::class,
],
'alias' => [
'Route'    => 'JK\\Routing\\Route',
'Request'  => 'JK\\Http\\Request',
'Auth'     => 'JK\\Security\\Authenticate\\Auth',
'Asset'    => 'JK\\View\\Components\\Asset',
'View'     => 'JK\\View\\View',
'HTML'     => 'JK\\View\\Components\\HTML', 
'Config'   => 'JK\\Config\\Config',
'Url'      => 'JK\\Helper\\Url',
'DI'       => 'JK\\DI\\Container',
'DB'       => 'JK\\Database\\Database',
'Query'    => 'JK\\ORM\\Query',
'QB'       => 'JK\\ORM\\QueryBuilder'
],
'commands' => [
\JK\Foundation\Commands\MakeControllerCommand::class,
\JK\Foundation\Commands\MakeModelCommand::class,
],
'cache_dir'     => '/temp/cache/',
'migration_dir' => '/temp/database/migrations/',
'seed_dir'      => '/temp/database/seeds/',
'log_file'      => 'temp/log/error.txt'

];
			
}