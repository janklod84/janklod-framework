<?php 
namespace JK\Foundation\Generators;


/**
 * @package JK\Foundation\Generators\ControllerGenerator
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
    $name =  ucfirst($this->input(2)).'Controller';
    if($this->input(3) === '--no-suffix')
    {
        $name = $this->input(2);
    }
    $content = sprintf($this->blank(), $name);
    $this->setContent($content);
    $filename = sprintf('%s.php', $name);
    $this->setFilename($filename);
    $fullname = sprintf('app\\controllers\\%s', $name);
    $message =  sprintf(
      'Controller [ %s ] successfully generated!', 
      $fullname
    );
    $this->success($message);
}


/**
* Generate controller
* 
* @return void
*/
public function generate()
{
    parent::generate();
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