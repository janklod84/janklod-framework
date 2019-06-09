<?php 
namespace JK\Console\Generators;


/**
 * @package JK\Console\Generators\LayoutGenerator
*/ 
class LayoutGenerator
{

    
/**
* Generate layout
* 
* @return void
*/
public function generate()
{
  if(file_put_contents(__DIR__.'/test.php', $this->blank()))
  {
 	 return true;
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


class HomeController 
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