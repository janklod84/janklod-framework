<?php 
namespace JK\View\Facades;

use JK\DI\ServiceProvider;
use JK\View\Components\Asset;
use \Config;
use JK\Http\Url;


/**
 * @package JK\View\Facades\AssetProvider 
*/ 
class AssetProvider extends ServiceProvider
{
   
    /**
     * Bootstrap
     * 
     * @return void
     */
    public function boot()
    {
        // Configuration assets
        Asset::map(Config::group('asset'), Url::base());
    }
    
    /**
     * Register in container Dependency Injection
     * 
     * @return void
    */
    public function register()
    {
         // 
    }
}