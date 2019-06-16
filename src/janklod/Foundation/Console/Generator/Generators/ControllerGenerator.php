<?php 
namespace JK\Foundation\Console\Generator\Generators;


use JK\Foundation\Console\Generator\CustomGenerator;

/**
 * @package JK\Foundation\Console\Generator\Generators\ControllerGenerator
*/ 
class ControllerGenerator extends CustomGenerator
{
  
/**
 * @var string $directory
*/
protected $directory = 'app/controllers';


/**
 * Do something before generated action
 * 
 * @return void
*/
protected function before()
{
    $lower = strtolower($this->input(2));
    $name =  ucfirst($lower).'Controller';
    $content = sprintf($this->blank(), $name);
    $this->setContent($content);
    $filename = sprintf('%s.php', $name);
    $this->setFilename($filename);
    $this->name = sprintf('app\\controllers\\%s', $name);
}


/**
* Generate controller
* 
* @return void
*/
public function make()
{
     $success =  sprintf(
      'Controller [ %s ] successfully generated!', 
      $this->name
     );
     $fail = sprintf(
     'Cant make file [ %s ], may be something went wrong!',  
     $this->name
     );
     $this->success($success);
     $this->fail($fail);
     parent::make();
}


/**
 * Delete generated file
 * 
 * @return bool
*/
public function delete()
{
   /* Full path of controller $this->path() */
   $success =  sprintf(
      'Controller [ %s ] successfully deleted!', 
      $this->name
   );
   $fail = sprintf(
    'Cant not delete controller [%s], may be file does not exist!', 
    $this->name
   );
   $this->success($success);
   $this->fail($fail);
   parent::delete();
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


/**
 * @package [ class ]
*/
class %s  extends Controller
{
  
  /**
   * @var string $"."layout
  */
  protected  $"."layout = '';
  

  /**
   * Do something before action 
   *
   * @return 
  */
  public function before()
  {
      // Do action
  }

  
  /**
   * Constructor 
   *
   * @param \JK\Container\ContainerInterface $"."app 
   * @return void
  */
  public function __construct($"."app)
  {
      parent::__construct($"."app);
  }


  /** 
   * Action index 
   *
   * @return mixed 
  */
  public function index()
  {
      // Add your code here ...
  } 


  /**
   * Do something after action 
   *
   * @return 
  */
  public function after()
  {
      // Do action
  }

    
}
"; 

return $template;
}


}