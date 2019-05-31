<?php 
namespace JK\Routing;

use \Config;
use JK\Debug\PrettyPrint;



/**
 * @package JK\Routing\Controller
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
protected $layout = 'default';
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
     $this->view->setLayout(
        $this->mapLayout()
     );
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
public function after(){}



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
 * Get view automatically by name controller
 * 
 * @return void
*/
public function getView()
{
    if($autoview === true)
    {
         //
    }
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
     $this->view->render();
}



/**
* map layout
* @return mixed
*/
protected function mapLayout()
{
   if(!$this->layout)
   { return false; }
   else{ 
     if(Config::get('view.layout') !== '')
     {
          $this->layout = Config::get('view.layout');
     }
     return 'layouts/'. $this->layout;
  }
}



/**
* Show currents view , layout, and controller
* @return void
*/ 
public function pretty()
{
     $this->app->merge([
        'current.controller'  => $this->currentController(),
        'current.view.path'   => $this->view->viewPath(),
        'current.layout.path' => $this->view->layoutPath()
     ]);

     $pretty = new PrettyPrint($this->app);
     $pretty->output(\Config::get('app.debug'));
}



/**
 * Get name current controller
 * @return string
*/
private function currentController()
{
    return $this->load->currentObjectName($this);
}

/**
 * Determine if has isset path
 * @return bool
*/
private function hasPath()
{
    return $this->layout 
           && $this->view->viewPath(); 
}



private function getFolder()
{

}
}