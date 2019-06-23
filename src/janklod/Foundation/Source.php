<?php 
namespace JK\Foundation;


/**
 * @package JK\Foundation\Source
*/ 
class Source
{


/**
* Base Configuration of application
*/
const CONFIG = [
'runners' => [
\JK\Foundation\Runners\AliasRunner::class,
\JK\Foundation\Runners\ProviderRunner::class,
\JK\Foundation\Runners\FunctionRunner::class
],
'providers' => [
\JK\Http\Facades\SessionProvider::class,
\JK\Http\Facades\ResponseProvider::class,
\JK\Loader\Facades\LoaderProvider::class,
\JK\View\Facades\AssetProvider::class,
\JK\View\Facades\ViewProvider::class,
\JK\Security\Facades\AuthenticateProvider::class,
\JK\Database\Facades\DatabaseProvider::class,
\JK\CacheSystem\Facades\CacheProvider::class,
\JK\Validation\Facades\ValidationProvider::class,
],
'alias' => [
'Route'    => 'JK\\Routing\\Route',
'Request'  => 'JK\\Http\\Request',
'Auth'     => 'JK\\Security\\Authentication\\Auth',
'Asset'    => 'JK\\View\\Components\\Asset',
'View'     => 'JK\\View\\View',
'HTML'     => 'JK\\View\\Components\\HTML', 
'Config'   => 'JK\\Config\\Config',
'Url'      => 'JK\\Http\\Url',
'DI'       => 'JK\\DI\\Container',
'DB'       => 'JK\\Database\\Database',
'QB'       => 'JK\\ORM\\QueryBuilder',
'Form'     => 'JK\\Library\\HTML\\Forms\\BootstrapForm'
],
'commands' => [
# COMMANDS GENERATOR
\JK\Routing\Commands\MakeControllerCommand::class,
\JK\Routing\Commands\DeleteControllerCommand::class,
\JK\Database\Commands\MakeModelCommand::class,
\JK\Database\Commands\DeleteModelCommand::class,
# COMMANDS SERVER
\JK\Http\Commands\ServerCommand::class,
# COMMANDS MIGRATION
// \JK\Database\Migrations\Commands\CreateTableCommand::class,
// \JK\Database\Migrations\Commands\DeleteTableCommand::class,
// \JK\Database\Migrations\Commands\UpdateTableCommand::class,
// \JK\Database\Migrations\Commands\MigrateCommand::class,
// \JK\Database\Migrations\Commands\RollbackCommand::class,
],
'cache.dir'     => '/temp/framework/cache/',
'migration.dir' => '/temp/database/migrations/',
'seed.dir'      => '/temp/database/seeds/',
'session.dir'   => '/temp/framework/sessions',
'log.file'      => 'temp/logs/',
];
			
}