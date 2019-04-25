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
	   * Constructor
	   * @param mixed $parsed
	   * @return void
	  */
	  public function __construct($parsed)
	  {
             $this->parsed = $parsed;
	  }

      
      /**
       * Create current container
       * @param array $params 
       * @return \JK\Container\ContainerInterface
      */
	  public function create($params = [])
	  {
            if(is_string($this->parsed))
            {
                $this->parsed = new $this->parsed($params);
            }
            return $this->parsed;
	  }
}