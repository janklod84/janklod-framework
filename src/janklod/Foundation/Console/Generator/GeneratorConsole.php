<?php 
namespace JK\Foundation\Console\Generator;


/**
 * class GeneratorConsole
 * Receiver
 *
 * @package JK\Foundation\Console\Generator\GeneratorConsole
*/ 
class GeneratorConsole
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
 * Make controller
 * 
 * @return string
*/
public function makeController()
{
    return $this->controller()->make();
}



/**
 * Delete controller
 * 
 * @return void
*/
public function deleteController()
{
    return $this->controller()->delete();
}


/**
 * Make model
 * 
 * @return string
*/
public function makeModel()
{
    return $this->model()->make();
}



/**
 * Delete model
 * 
 * @return void
*/
public function deleteModel()
{
    return $this->model()->delete();
}


/**
 * Get controller
 * 
 * @return 
*/
private function controller()
{
   return $this->factory->get('controller');
}

/**
 * Get model
 * 
 * @return 
*/
private function model()
{
   return $this->factory->get('model');
}

}