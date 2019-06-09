<?php 
namespace JK\Foundation\Generators;


/**
 * @package JK\Foundation\Generators\ControllerGenerator
*/ 
class ControllerGenerator extends CustomGenerator
{
      
/**
* Generate controller
* 
* @return void
*/
public function generate()
{

  $controller_dir =  $this->basePath('app/controllers');
  $name =  ucfirst($this->input(2)).'Controller';
  if($this->input(3) === '--no-prefixed')
  {
      $name = $this->input(2);
  }
  $controller_name = $name;
  $filename = sprintf('%s.php', $controller_name);
  $generatedFile = $this->make($controller_dir, $filename);
  $content = sprintf($this->blank(), $controller_name);
  
  if($this->put($generatedFile, $content))
  {
      return $controller_name;
  }
  return false;
}


/**
 * Blank controller
 * 
 * @return string
*/
public function blank()
{
$template="<?php 
namespace app\controllers;

use JK\Routing\Controller;


class %s 
{

  /** 
   * Action index 
   *
   * @return mixed 
  */
  public function index()
  {

  }   
}
"; 

return $template;
}


}