<?php 
namespace JK\Console;



/**
 * @package JK\Console\TaskConsole
*/ 
class Task
{
     
const GEN_NAMESPACE = '\\JK\\Foundation\\Console\\Generators\\%s';


/**
 * Generator item
 * 
 * @var string $name
 * @var string $input
 * @var array $arguments
 * @return bool
*/
public function generate($name, $input='', $arguments = [])
{
    switch($name)
    {
	  case 'controller';
	    $generator = ControllerGenerator;
      break;
      default:
        exit('Can not generate this type name!');
      break;
    }
	$handle = sprintf(self::GEN_NAMESPACE, $generator);
	return (new $handle($input))->generate();
}

}