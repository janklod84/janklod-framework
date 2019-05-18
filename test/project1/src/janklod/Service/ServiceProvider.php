<?php 
namespace JK\Service;


use JK\DI\ContainerInterface;


/**
 * @package JK\Service\ServiceProvider
*/ 
abstract class ServiceProvider 
{
       
	       /**
	        * @var \JK\DI\ContainerInterface
	       */
	       protected $app;


           /**
            * Constructor
            * @param ContainerInterface $app 
            * @return void
           */
	       public function __construct(ContainerInterface $app)
	       {
	       	    $this->app = $app;
	       	    $this->boot();
	       }

           
           /**
            * Do something before register
            * @return mixed
           */
           protected function boot() {}
           

           /**
            * Register provider
            * @return void
           */
	       abstract public function register();
}