<?php 
namespace JK\View\Facades;

use JK\DI\ServiceProvider;
use JK\View\View;

/**
 * @package JK\View\Facades\ViewProvider 
*/ 
class ViewProvider extends ServiceProvider
{
        
    /**
     * Register service
     * 
     * @return void
    */
    public function register()
    {
        $this->app->singleton('view', function () {
             return $this->app->make(View::class, [
                 $this->app->file->to('app/views/')
             ]);
        });
    }

    
    /**
     * Add provides
     * 
     * @return void
    */
    public function after()
    {
        $this->app->add([
            'current.view.path'   => $this->app->view->viewPath(),
            'current.layout.path' => $this->app->view->layoutPath()
        ]);
    }
}