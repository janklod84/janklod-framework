<?php 
namespace JK\Template;



use JK\Template\Components\HTML;


/**
 * @package JK\Template\View
*/
class View  implements ViewInterface
{

/**
* @var string  $layout
* @var string  $view
* @var array   $data 
* @var array   $meta [ add meta data ]
* @var string  $viewPath
* @var string  $partialDir
* @var bool  $show [ Determine if show render or not ]
*/
private $layout;
private $view;
private $data = [];
private $meta = [];
private $viewPath = ''; 
private $partialDir;
private $show = true;


/**
* Constructor
* @param string $viewPath
* @return void
*/
public function __construct($viewPath = '')
{
    $this->viewPath =  trim($viewPath, '/');
}


/**
* add layout
* @param bool $status
* @return void
*/
public function show(bool $show=true)
{
    $this->show = $show;
}


/**
* add layout
* @param string $partialDir directory 
* @return void
*/
public function partialDir($partialDir = '')
{
    $this->partialDir = $partialDir;
}


/**
* add layout
* @param string $layout 
* @return void
*/
public function setLayout($layout = '')
{
    $this->layout = $layout;
}


/**
* set view
* @param string $view 
* @return void
*/
public function setView($view = '')
{
     $this->view = $view;
}


/**
* set datas
* @param array $data
* @return void
*/
public function setData($data = [])
{
     $this->data = $data;
}


/**
 * Set metas
 * @param string $title 
 * @param string $desc 
 * @param string $keywords 
 * @return void
*/
public static function setMeta($title='', $desc='', $keywords='')
{
      HTML::setTitle($title);
      HTML::setMeta('description', $desc);
      HTML::setMeta('keywords', $keywords);
}


/**
 * Get meta
 * @param bool $charset
 * @return void
*/
public static function getMeta($charset = true)
{
      if($charset === true)
      {HTML::charset();}
      HTML::title();
      HTML::meta();
}


/**
* View render
* @param string $view
* @param array  $data
* @return void
*/
public function render()
{
  if(!$this->show)
  {return false;}
  $this->runBuffer();
}


/**
* Buffering
* @return void
*/
public function runBuffer()
{
     extract($this->data);
     ob_start();
     require_once $this->viewPath();
     $content = ob_get_clean();
     if($this->layout != false)
     {
         require_once $this->layoutPath();
     }
}


/**
 * Render full path layout
 * @return string
*/
public function layoutPath()
{
    return $this->fullPath($this->layout);
}


/**
 * Render full path view
 * @return string
*/
public function viewPath()
{
    return $this->fullPath($this->view);
}



/**
* output view
* @return mixed
*/
public function output()
{
    return $this->render();
}


/**
* stringify output
* @return string
*/
public function __toString()
{
   return $this->output();
}


/**
 * Get full path of view
 * @param string $path 
 * @return string
*/
public function fullPath($path)
{
    if($this->viewPath && $path)
    {
         $direction = sprintf('%s/%s.php', 
           $this->viewPath,  
           trim($path, '/')
         );
        if(!file_exists($direction))
        {
           exit(sprintf(
            'Sorry view file <strong>%s</strong> does not exist!', 
            $direction)
           );
        }
        return realpath($direction);
    }
    return false;
}


/**
 * Partials
 * @param string $path 
 * @param string $parent
 * @return void
*/
public function partial($path='', $parent='layouts')
{
   $file = $this->partialPath($path, $parent);
   include($file);
}


/**
 * Get full partial path
 * @param string $path 
 * @param string $parent 
 * @return string
*/
public function partialPath($path, $parent)
{
    $path = trim($path, '/');
    $this->partialDir = trim($this->partialDir, '/');
    if(!$this->partialDir){$this->partialDir = $path;}
    else{$this->partialDir = $this->partialDir . '/'. $path; }
     $file = sprintf(
        '%s/%s/%s.php', 
        $this->viewPath, 
        trim($parent, '/'),
        $this->partialDir
     );
     if(!file_exists($file))
     {
         exit(sprintf(
            'Sorry Partial path <b>%s</b> does not exist!', $file
         ));
     }
     return realpath($file);
}


}