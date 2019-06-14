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
'QB'       => 'JK\\ORM\\QueryBuilder',
],
'commands' => [
\JK\Foundation\Commands\MakeControllerCommand::class,
\JK\Foundation\Commands\MakeModelCommand::class,
\JK\Foundation\Commands\DeleteControllerCommand::class,
\JK\Foundation\Commands\DeleteModelCommand::class
],
'cache.dir'     => '/temp/cache/',
'migration.dir' => '/temp/database/migrations/',
'seed.dir'      => '/temp/database/seeds/',
'session.dir'   => '/temp/framework/sessions',
'log.file'      => 'temp/logs/',
];
			
}