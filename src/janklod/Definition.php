<?php 
namespace JK;


/**
 * @package JK\Definition 
*/ 
class Definition 
{
	  
	    /**
         * Base Configuration of application
        */
        const CONFIG = [
             'providers' => [
	            \JK\Http\Facades\RequestProvider::class,
	            \JK\Http\Facades\ResponseProvider::class,
	            \JK\Routing\Facades\RouterProvider::class, 
	            \JK\Loader\Facades\LoaderProvider::class,
	            /*
	            \JK\Template\Facades\ViewProvider::class,
	            \JK\Database\Facades\DatabaseProvider::class,
	            \JK\Validation\Facades\ValidationProvider::class,
	           */
	        ],
	        'alias' => [
                 'Route'    => 'JK\\Routing\\Route',
	             'Asset'    => 'JK\\Template\\Asset',
	             'HTML'     => 'JK\\Template\\HTML', 
	             'Config'   => 'JK\\Config\\Config',
            ],
        ];
			
}