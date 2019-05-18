<?php 
namespace JK\DI;


/**
 * @package JK\DI\ContainerBuilder
*/ 
class ContainerBuilder
{
	  

	    /**
          * @var mixed
        */
	    private $parsed;

        
        /**
         * @var array
        */
        private $definitions = [];

  
        /**
         * Add your container
         * @param mixed $parsed
         * @return $this
         */
        public function addContainer($parsed)
        {
             $this->parsed = $parsed;
             return $this;
        }


        /**
         * Add definitions
         * @param mixed $definition 
         * @return void
        */
        public function addDefinitions($definition)
        {
              if(is_string($definition) && is_file($definition))
              {
                  $definition = require_once($definition);
              }
              $this->definitions = (array) $definition;
              return $this;
        }


        /**
         * Create current container
         * @return \JK\Container\ContainerInterface
        */
        public function build(): ContainerInterface
        {
            if(is_string($this->parsed))
            {
                $this->parsed = new $this->parsed($this->definitions);
            }
            return $this->parsed ?: new Container($this->definitions);
        }

}