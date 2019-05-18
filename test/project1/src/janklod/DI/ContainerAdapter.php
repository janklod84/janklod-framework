<?php 
namespace JK\DI;


/**
 * @package JK\DI\ContainerAdapter 
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
           $this->container->set($key, $value);
	  }


	  /**
       * Determine if has key in container
       * @param string $key
       * @return bool
      */
	  public function has($key): bool
	  {
          return $this->container->has($key);
	  }


	  /**
       * Remove item from container
       * @param string $key
       * @return void
      */
	  public function remove($key)
	  {
          $this->container->remove($key);
	  }
}