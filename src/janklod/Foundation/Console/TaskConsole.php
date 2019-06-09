<?php 
namespace JK\Routing\Console;


use JK\Routing\Console\Generators\ControllerGenerator;

/**
 * @package JK\Routing\Console\TaskManager
*/ 
class TaskManager
{
     
/**
 * Generator controller
 * 
 * @var string $name
 * @var string $input
 * @var array $arguments
 * @return bool
*/
public function generate($name='', $input='', $arguments = [])
{
    switch($name)
    {
	  case 'controller';
	    $controller = new ControllerGenerator($input);
        return $controller->generate();
      break;
      default:
        exit('Can not generate this type name!');
      break;
    }
}

}