<?php 
namespace JK\Foundation\Console\Generator;

use \Exception;


/**
 * Class GeneratorAdapter
 *
 * @package JK\Foundation\Console\Generator\GeneratorFactory
*/ 
class GeneratorFactory
{
  
/**
 * @var InputInterface $input 
 * @var OutputInterface $output 
*/
private $input;
private $output;



/**
 * Constructor
 * 
 * @param InputInterface $input 
 * @param OutputInterface $output 
 * @return void
 */
public function __construct($input, $output)
{
    $this->input  = $input;
    $this->output = $output;
}    


/**
* 
* @param string $name 
* @return GeneratorAdapter
*/
public function get($name='')
{
   $classname = sprintf(
   '\\JK\\Foundation\\Console\\Generator\\Generators\\%sGenerator', 
   ucfirst($name)
   );
   if(! class_exists($classname))
   {
   	   throw new Exception(
   	   	sprintf('Sorry, classe [ %s ] does not exist!', $classname)
   	   );
   }
   $generator = new $classname($this->input, $this->output);
   return new GeneratorAdapter($generator);
}


}