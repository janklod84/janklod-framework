<?php 
namespace JK\Foundation\Console;



/**
 * Class [ Factory ] Task
 * Receiver command 
 *
 * @package JK\Foundation\Console\Task
*/ 
class Task
{


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
  $generator = sprintf(
  '\\JK\\Foundation\\Console\\Generators\\%sGenerator', 
  $name);

  if(!class_exists($generator))
  { exit(sprintf('Sorry, class [%s] does not exist!', $generator)); }

  $handler = [new $generator($input), 'generate'];

  if(is_callable($handler))
  {
     return call_user_func($handler);
  }
}

}