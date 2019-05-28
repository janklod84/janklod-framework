<?php 
namespace JK\Routing;


use JK\Template\ViewAdapter;


/**
 * @package 
*/
abstract class Controller 
{
       
/**
* @var \JK\DI\ContainerInterface $app
* @var \JK\Loader\Load $load
* @var \JK\Template\View $view
* @var \JK\Http\Request $request
* @var string $layout
* @var array $data
* @var string $autoview 
* [ set automatically view by using controller and action ]
*/
protected $app;
protected $load;
protected $view;
protected $request;
protected $layout;
protected $autoview = true;

 
/**
* Constructor
* @param \JK\DI\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     $this->app     = $app;
     $this->view    = $app->view;
     $this->request = $app->request;
     $this->load    = $app->load;
}

 
/**
* Set data
* @param array $data 
* @return void
*/
protected function set($data = [])
{
    $this->view->setData($data);
}


/**
 * 
 * @param type $name 
 * @return type
*/
public function __get($name)
{

}



/**
* View render
* @param string $view 
* @param array $data 
* @return mixed
*/
protected function render($view, $data = [])
{
     $this->view->setView($view);
     $this->view->setData($data);
     $this->view->setLayout(
        $this->mapLayout()
     );
     (new ViewAdapter($this->view))->render();
     $this->view->currentViewPath(); // show current view path
}

/**
* map layout
* @return mixed
*/
protected function mapLayout()
{
   if($this->layout === false)
   { return false; }
   else{ return $this->layout ?: \Config::get('view.layout'); }
}


/**
* Must to add later next functionnality
* Do something before calling action
* @return void
*/
public function before() {}


/**
* Must to add later next functionnality
* Do something after calling action
* @return void
*/
public function after() {}




}