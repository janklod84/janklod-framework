<?php 
namespace JK\Template\Facades;

use JK\Service\ServiceProvider;
use JK\Template\View;

/**
 * @package JK\Template\Facades\ViewProvider 
*/ 
class ViewProvider extends ServiceProvider
{
        
    /**
     * Register service
     * @return void
    */
    public function register()
    {
        $this->app->singleton('view', function () {
             return new View(
                $this->app->file->to('app/views/')
             );
        });
    }
}