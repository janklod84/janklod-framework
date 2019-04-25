<?php 
namespace JK\Container;


/**
 * @package JK\Container\ContainerAdapter 
*/ 
class ContainerAdapter 
{
	  

	  /**
        * @var ContainerInterface
      */
	  private $container;



	  /**
	   * Constructor
	   * @param ContainerInterface $container
	   * @return void
	  */
	  public function __construct(ContainerInterface $container)
	  {
             $this->container = $container;
	  }

      
      /**
       * Get container
       * @param string $key
      */
	  public function get($key) 
	  {
           return $this->container->get($key);
	  }


	  /**
       * set item container
       * @param string $key
       * @param mixed $value
      */
	  public function set($key, $value) 
	  {
          return $this->container->set($key, $value);
	  }
}