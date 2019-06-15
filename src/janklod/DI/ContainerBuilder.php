<?php 
namespace JK\DI;


use JK\DI\Contracts\ContainerInterface;

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
* Add container you want to use
* Exemple:
* $this->addContainer(DI::class)
* $this->addContainer(new DI())
* 
* @param string|object $container 
* @return void
*/
public function addContainer($parsed)
{
     $this->parsed = $parsed;
     return $this;
}

/**
* Add definition
* $this->addDefinition(__DIR__.'/config.php')
* $this->addDefinition([
*   'JK\Helper\Test' => function () {
*        return new Test();
*    },
*    'file' => new File(__DIR__),
*    'newtest' => ...
* ])
* 
* @param string|array $definition 
* @return $this
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
    return $this->parsed ?: Container::instance($this->definitions);
}

}