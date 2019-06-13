<?php 
namespace JK\Foundation\Generators;


/**
 * @package JK\Foundation\Generators\ModelGenerator
*/ 
class ModelGenerator extends CustomGenerator
{


/**
 * @var string $directory
*/
protected $directory = 'app/models';


/**
 * Do something before generated action
 * 
 * @return void
*/
protected function before()
{
    $name =  ucfirst($this->input(2));
    $content = sprintf($this->blank(), $name);
    $this->setContent($content);
    $filename = sprintf('%s.php', $name);
    $this->setFilename($filename);
    $fullname = sprintf('app\\models\\%s', $name);
    $message =  sprintf(
      'Model [ %s ] successfully generated!', 
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
namespace app\models;


class %s
{

   /**
    * @param string $"."table
   */
   protected $"."table = '';
   
   /**
    * Constructor 
   */
   public function __construct()
   {
   	   parent::__construct();
   }

}
"; 

return $template;
}


}