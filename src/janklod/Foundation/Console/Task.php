<?php 
namespace JK\Foundation\Console;



/**
 * Class [ Factory ] Task execute task from console 
 * Receiver command 
 *
 * @package JK\Foundation\Console\Task
*/ 
class Task
{
     
const GEN_NAMESPACE = '\\JK\\Foundation\\Generators\\%sGenerator';


/**
 * Generator item
 * 
 * @var string $name
 * @var \JK\Console\IO\InputInterface $input
 * @return bool
*/
public function generate($name, $input)
{
  $name = ucfirst(strtolower($name));
  $generator = sprintf(self::GEN_NAMESPACE, $name);

  if(!class_exists($generator))
  { exit(sprintf('Sorry, class [%s] does not exist!', $generator)); }

  $handler = [new $generator($input), 'generate'];

  if(is_callable($handler))
  {
     return call_user_func($handler);
  }
}

}