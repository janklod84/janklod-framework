<?php 
namespace JK\Foundation\Console;


use JK\Console\ConsoleInterface;
use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Foundation\Generators\GeneratorInterface;
use JK\Foundation\Generators\{
    ControllerGenerator,
    ModelGenerator
};


/**
 * class [ Factory ] Console
 * Receiver
 *
 * @package JK\Foundation\Console\Console
*/ 
class Console implements ConsoleInterface
{

/**
 * @var mixed action
*/
private $action;



/**
 * Run and execute commands
 * 
 * @param string $task
 * @param InputInterface $input
 * @param OutputInterface $output
 * 
 * @return mixed
*/
public function execute(
$signature='', 
InputInterface $input, 
OutputInterface $output
)
{
    if($input->argument(1) !== $signature)
    {  exit('No matches commands!'); }

    switch($signature)
    {
        case 'make:controller':
           $this->action = $this->generate(
             new ControllerGenerator($input, $output)
           );
        break;
        case 'make:model':
           $this->action = $this->generate(
             new ModelGenerator($input, $output)
           );
        break;
        default:
           $this->action = 'Not Found signature!';
        break;
    }
    return $this->action;
}



/**
 * Generate file
 * 
 * @var \JK\Foundation\Generators\GeneratorInterface $generator
 * @var \JK\Console\IO\InputInterface $input
 * @var \JK\Console\IO\OutputInterface $output
 * @return bool
*/
public function generate(GeneratorInterface $generator)
{
  $handler = [$generator, 'generate'];
  if(is_callable($handler))
  {
     return call_user_func($handler);
  }
}

}