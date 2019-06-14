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
 * class [ Factory ] Generate
 * Receiver
 *
 * @package JK\Foundation\Console\Generate
*/ 
class Generate implements ConsoleInterface
{

/**
 * @var mixed action
*/
private $action;



/**
 * Execute concrete command
 * 
 * @param string $signature
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
        switch($signature)
        {
            case 'make:controller':
               $this->action = $this->do(
                 new ControllerGenerator($input, $output)
               );
            break;
            case 'make:model':
               $this->action = $this->do(
                 new ModelGenerator($input, $output)
               );
            break;
            return $this->action;
        }
    
}



/**
 * Generate file
 * 
 * @var \JK\Foundation\Generators\GeneratorInterface $generator
 * @var \JK\Console\IO\InputInterface $input
 * @var \JK\Console\IO\OutputInterface $output
 * @return bool
*/
public function do(GeneratorInterface $generator)
{
  $handler = [$generator, 'generate'];
  if(is_callable($handler))
  {
     return call_user_func($handler);
  }
}

}