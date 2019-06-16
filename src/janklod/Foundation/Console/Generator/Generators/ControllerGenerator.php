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
// protected $directory = 'Module/Eshop'; // ex: mod/test
protected $namespace;
protected $name;


/**
 * Do something before generated action
 * 
 * @return void
*/
protected function before()
{
    $second = strtolower($this->input(2));
    if($third = $this->input(3))
    {
         $parts = explode(':', $third, 2);
         if(!in_array('--path', $parts))
         {
              return false; 
         }
         $direction = $parts[1];
         $this->directory .= '/'. $direction;
         $this->namespace .= '\\'. $direction;
    }
    $name = ucfirst($second).'Controller';
    $this->setClassName($name);
    $content = sprintf($this->blank(), $this->namespace, $this->classname, $name);
    $this->setContent($content);
    $filename = sprintf('%s.php', $name);
    $this->setFilename($filename);
    
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
      $this->classname
     );
     $fail = sprintf(
     'Cant make file [ %s ], may be something went wrong!',  
      $this->classname
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
      $this->classname
   );
   $fail = sprintf(
    'Cant not delete controller [%s], may be file does not exist!', 
    $this->classname
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
namespace %s;

use JK\Routing\Controller;


/**
 * @package %s
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