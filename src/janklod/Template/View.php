<?php 
namespace JK\Template;




/**
 * @package JK\Template\View
*/
class View  implements ViewInterface
{

/**
* @var string  $layout
* @var string  $view
* @var array   $data 
* @var string  $viewPath
*/
private $layout;
private $view;
private $data = [];
private $viewPath = ''; 
private $output;


/**
* Constructor
* @param string $viewPath
* @return void
*/
public function __construct(string $viewPath = '')
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
* View render
* @param string $view
* @param array  $data
* @return void
*/
public function render()
{
     $this->runBuffer();
}


/**
* Buffering
* @return void
*/
protected function runBuffer()
{
     if($this->output === null)
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
    $direction = sprintf('%s/%s.php', 
       trim($this->viewPath, '/'),  
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

}