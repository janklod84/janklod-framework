<?php 
namespace JK\Foundation\Console\Generator\Generators;



use JK\Foundation\Console\Generator\CustomGenerator;

/**
 * @package JK\Foundation\Console\Generator\Generators\ModelGenerator
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
    $this->setClassName($name);
    $content = sprintf($this->blank(), $name);
    $this->setContent($content);
    $filename = sprintf('%s.php', $name);
    $this->setFilename($filename);
}


/**
* Generate model
* 
* @return void
*/
public function make()
{
     $success =  sprintf(
      'Model [ %s ] successfully generated!', 
      $this->classname
     );
     $fail = sprintf(
     'Cant make model [ %s ], may be something went wrong!',  
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
   /* Full path of model $this->path() */
   $success =  sprintf(
      'Model [ %s ] successfully deleted!', 
      $this->classname
   );
  $fail = sprintf(
    'Cant not delete model [ %s ], may be file does not exist!', 
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