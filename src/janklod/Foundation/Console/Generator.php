<?php 
namespace JK\Foundation\Console;


/**
 * class [ Factory ] Generator
 * Receiver
 *
 * @package JK\Foundation\Console\Generator
*/ 
class Generator
{


/**
 *@var  InputInterface   $input 
 *@var  OutputInterface  $output 
 *@var  GeneratorFactory $factory
*/
private $input;
private $output;
private $factory;


/**
 * Constructor
 * 
 * @param  InputInterface  $input 
 * @param  OutputInterface $output 
 * @return void
 */
public function __construct($input, $output)
{
     $this->factory = new GeneratorFactory($input, $output);
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
 * Get controller
 * 
 * @return 
*/
public function controller()
{
   return $this->factory->get('controller');
}

/**
 * Get model
 * 
 * @return 
*/
public function model()
{
   return $this->factory->get('model');
}

}