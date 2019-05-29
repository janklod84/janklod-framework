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
private $output = '';
 
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
     $this->view->render();
     $this->showCurrencies();
}


/**
* Show currents view , layout, and controller
* @return void
*/ 
public function showCurrencies()
{
    $html  = '<div class="container text-center">';
    $html .= '<h5>Currencies: </h5>';
    $html .= '<small>Current Controller:</small>'; 
    $html .= '<code>'. $this->currentController() . '</code>'; 
    $html .= '<br>';
    $html .= '<small>Current View path :</small>'; 
    $html .= '<code>'. $this->view->viewPath() .'</code>'; 
    $html .= '<br>';
    $html .= '<small>Current Layout path :</small>'; 
    $html .= '<code>'. $this->view->layoutPath() .'</code>'; 
    $html .= '</div>';
    echo $html;
}


/**
 * Get name current controller
 * @return string
*/
public function currentController()
{
    return $this->load->currentObject($this);
}


/**
* map layout
* @return mixed
*/
protected function mapLayout()
{
   if($this->layout === false)
   { return false; }
   else{ 
     $layout = $this->layout ?: \Config::get('view.layout'); 
     return 'layouts/'. $layout;
  }
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