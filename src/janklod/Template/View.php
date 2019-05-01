<?php 
namespace JK\Template;


/**
 * @package JK\Template\View
*/
class View  implements ViewInterface
{
	  
	  const TYPE_VIEW = ['head', 'body', 'foot'];

	  /**
	   * @var string $layout
	   * @var string $output
	  */
	  protected $layout;
	  protected $output;

	  protected $view;
	  protected $data = [];


	  /**
	   * Constructor
	   * @return void
	  */
	  public function __construct()
	  {

	  }

      
      /**
       * add layout
       * @param string $layout 
       * @return void
      */
      public function layout($layout = '')
      {
           $this->layout = $layout ?: 'default';
      }



      /**
       * add view
       * @param string $view 
       * @return void
      */
      public function segment($view = '')
      {
      	  $this->view = $view;
      }


      /**
       * add view
       * @param string $view 
       * @return void
      */
      public function data($data = [])
      {
      	  $this->data = $data;
      }


      /**
       * View render
       * @param string $view
       * @param array  $data
       * @return void
      */
	  public function render()
	  {
           extract($this->data);
           ob_start();
           require_once ROOT . 'app/views/' . $this->view . '.php';
           $content = ob_get_clean();
           require_once ROOT. 'app/views/layouts/' . $this->layout . '.php';
	  }

      
      /**
       * Used in the layouts to embed the head and body
       * @method content
       * @param string $type can be head or body
       * @return string returns the output buffer of head and body
      */
	  public function content($type)
	  {
	  	   if(!in_array($type, self::TYPE_VIEW))
	  	   {
	  	   	   return false;
	  	   }

	  	   return $this->{$type};
	  }

      
      /**
       * start the output buffer for the head or body
       * @param string 
       * @return void
      */
	  public function start($type)
	  {
	  	   $this->output = $type;
	  	   ob_start();
	  }

      
      /**
       * Get output
       * @return void
      */
	  public function end()
	  {
         foreach(self::TYPE_VIEW as $type)
         {
         	  if($this->output == $type)
         	  {
         	  	  $this->{$type} = ob_get_clean();
         	  	  break;
         	  }
         }
         die('Yout must first run the start method.');
	  }

      
      /**
       * output view
       * @return mixed
      */
      public function output()
      {
      	  return $this->render();
      }
}