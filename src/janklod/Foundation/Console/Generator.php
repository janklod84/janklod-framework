<?php 
namespace JK\Foundation\Console;


use JK\Foundation\Generators\GeneratorInterface;
use JK\Foundation\Generators\{
    ControllerGenerator,
    ModelGenerator
};


/**
 * class [ Factory ] FileConsole
 * Receiver
 *
 * @package JK\Foundation\Console\Generator
*/ 
class Generator
{


private $input;
private $output;



/**
 * Constructor
 * 
 * @param  InputInterface  $input 
 * @param  OutputInterface $output 
 * @return void
 */
public function __construct($input, $output)
{
     $this->input  = $input;
     $this->output = $output;
}


/**
 * Execute concrete command
 * 
 * @param string $signature
 * @return mixed
*/
public function execute($signature='')
{
      switch($signature)
      {
          case 'make:controller':
            return $this->controller()
                   ->make();
          break;
          case 'delete:controller':
            return $this->controller()
                   ->delete();
          break;
          case 'make:model':
             return $this->model()
                   ->make();
          break;
          case 'delete:model':
            return $this->model()
                   ->delete();
          break;

      }
    
}



/**
 * Controller generator
 * 
 * @return ControllerGenerator
*/
public function controller(): ControllerGenerator
{
    return new ControllerGenerator($this->input, $this->output);
}


/**
 * Model generator
 * 
 * @return ModelGenerator
*/
public function model(): ModelGenerator
{
    return new ModelGenerator($this->input, $this->output);
}

}