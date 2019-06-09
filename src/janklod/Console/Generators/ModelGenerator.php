<?php 
namespace JK\Console\Generators;


/**
 * @package JK\Console\Generators\ModelGenerator
*/ 
class ModelGenerator extends CustomGenerator
{

    
/**
* Generate model
* 
* @return void
*/
public function generate()
{
  
}


/**
 * Blank controller
 * 
 * @return string
*/
public function blank()
{
$template="<?php 
namespace app\models;


class %s
{

  
}
"; 

return $template;
}


}