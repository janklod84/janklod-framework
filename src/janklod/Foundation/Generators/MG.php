<?php 
namespace JK\Foundation\Generators;


/**
 * @package JK\Foundation\Generators\ModelGenerator
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
     
  /*-- Configuration:MODULE_DIR['model']; --*/
  $model_dir =  'app/models'; 
  $name =  ucfirst($this->input(2));
  $model_name = $name;
  $filename = sprintf('%s.php', $model_name);
  $generated_file = $this->file->make($model_dir, $filename);

  $content = sprintf($this->blank(), $model_name);
  
  if($this->file->put($generated_file, $content))
  {
      return sprintf('app\\models\\%s', $model_name);
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