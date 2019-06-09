<?php 
namespace JK\Console;



/**
 * @package JK\Console\Task
*/ 
class Task
{
     
const GEN_NAMESPACE = '\\JK\\Console\\Generators\\%sGenerator';


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