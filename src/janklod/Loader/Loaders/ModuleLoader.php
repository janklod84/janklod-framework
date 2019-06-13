<?php 
namespace JK\Loader\Loaders;


use \Exception;


/**
 * @package JK\Loader\Loaders\ModuleLoader
*/ 
class ModuleLoader extends CustomLoader
{

/**
* Get full name module
* 
* @param string $name
* @return string
*/
public function name(string $name)
{
   return $this->getModule('\\modules', $name);
}

}