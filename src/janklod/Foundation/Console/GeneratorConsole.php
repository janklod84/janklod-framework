<?php 
namespace JK\Foundation\Console;


use JK\Console\ConsoleInterface;
use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;


/**
 * class [ Factory ] GeneratorConsole
 * Receiver
 *
 * @package JK\Foundation\Console\GeneratorConsole
*/ 
class GeneratorConsole
{


/**
 * Run and execute commands
 * 
 * @param string $task
 * @param InputInterface $input
 * @param OutputInterface $output
 * 
 * @return mixed
*/
public function execute($task='', $input, $output)
{
     
}



public function controller()
{

}


public function model()
{

}
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