<?php 
namespace JK;


/**
 * @package JK\Loader
*/ 
class Loader 
{
       
       
        /**
         * @var \JK\Application
        */
        private $app;



        /**
         * 
         * @param \JK\Application $app 
         * @return void
         */
	    public function __construct(Application $app)
	    {
               $this->app = $app;
	    }
}