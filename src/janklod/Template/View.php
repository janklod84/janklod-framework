<?php 
namespace JK\Template;


use \Config;
use \JK\FileSystem\File;


/**
 * @package JK\Template\View
*/
class View  implements ViewInterface
{

    /**
     * @var string  $layout
     * @var string  $output
     * @var string  $view
     * @var array   $data 
     * @var string  $viewPath
     * @var \JK\FileSystem\File  $file
    */
    protected $layout;
    protected $output;
    protected $view;
    protected $data = [];
    protected $viewPath = '';
    protected $file;


    /**
     * @var string $head
     * @var string $body
     * @var string $foot
    */
    private $head;
    private $body;
    private $foot;



   const TYPE_PART = ['head', 'body', 'foot'];



    /**
     * Constructor
     * @return void
    */
    public function __construct($viewPath = '')
    {
         $this->file = new File($viewPath);
    }


  /**
   * Set view path
   * @param string $viewPath 
   * @return void
  */
  public function setViewPath($viewPath = '')
  {
      $this->viewPath = $viewPath;
  }


  /**
   * add layout
   * @param string $layout 
   * @return void
  */
  public function setLayout($layout = '')
  {
       if($layout === false)
       {
          $this->layout = false;
          
       }else{
           
          $this->layout = $layout ?: Config::get('view.layout');
       }
  }


  /**
   * add view
   * @param string $view 
   * @return void
  */
  public function setPath($view = '')
  {
  	   $this->view = $view;
  }


  /**
   * add view
   * @param string $view 
   * @return void
  */
  public function setData($data = [])
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
      $this->getBuffer();
  }


  /**
   * Store buffer
   * @return void
  */
  private function getBuffer()
  {
      extract($this->data);
      ob_start();
      require_once $this->viewPath($this->view);
      $content = ob_get_clean();
      if($this->layout != false)
      {
          require_once $this->viewPath('layouts/' . $this->layout);
      }
  }



  /**
   * Get viewPath and make sure that file exist
   * @param string $path 
   * @return string
  */
  private function viewPath($path)
  {
       $file = $path . '.php';

       if(!$this->file->exists($file))
       {
          exit(
            sprintf('File <strong>%s</strong> does not exist', $this->file->to($file))
         );
       }

       return $this->file->to($file);
  }


  /**
   * Used in the layouts to embed the head and body
   * @method content
   * @param string $type can be head or body
   * @return string returns the output buffer of head and body
  */
  public function content($type)
  {
       if(!in_array($type, self::TYPE_PART))
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
      foreach(self::TYPE_PART as $type)
      {
           if($this->output == $type)
           {
               $this->{$type} = ob_get_clean();
           }
      }
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