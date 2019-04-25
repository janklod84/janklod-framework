<?php 
namespace JK\Container;


/**
 * @package JK\Container\ContainerBuilder
*/ 
class ContainerBuilder
{
	  

	  /**
        * @var mixed
      */
	  private $parsed;

      
      /**
       * @var array params 
      */
      private $params = [];



	  /**
	   * Constructor
	   * @param mixed $parsed
	   * @return void
	  */
	  public function __construct($parsed)
	  {
             $this->parsed = $parsed;
	  }

      
      
      /**
       * Set parameters
       * @param array $params 
       * @return void
      */
      public function parameters($params = [])
      {
            $this->params = $params;
            return $this;
      }


      /**
       * Create current container
       * @param array $params 
       * @return \JK\Container\ContainerInterface
      */
	  public function create(): ContainerInterface
	  {
            if(is_string($this->parsed))
            {
                $this->parsed = new $this->parsed($this->params);
            }
            return $this->parsed;
	  }

}