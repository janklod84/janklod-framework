<?php 
namespace JK\Routing;


use \Config;
use \HTML;
use \View;


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
* @var \JK\Http\Response $response
* @var string $layout
* @var array $data
* @var string $autoview 
* [ set automatically view by using controller and action ]
*/
protected $app;
protected $load;
protected $view;
protected $request;
protected $response;
protected $layout = 'default';
protected $autoview = true;


/**
* Constructor
* @param \JK\DI\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     $this->app      = $app;
     $this->view     = $app->view;
     $this->request  = $app->request;
     $this->load     = $app->load;
     $this->response = $app->response;
     $this->onConstructor();
}


/**
* Must to add later next functionnality
* Do something before calling action
* 
* @return void
*/
public function before() {}


/**
* Must to add later next functionnality
* Do something after calling action
* 
* @return void
*/
public function after(){}



/**
* Set data
* 
* @param array $data 
* @return void
*/
protected function set($data = [])
{
    $this->view->setData($data);
}


/**
 * Get title format
 * 
 * @param string $title 
 * @param string $current
 * @param string $divider 
 * @return string
*/
public function formatTitle($title='', $current = null, $divider='|')
{
    if(!is_null($current))
    { $title .= sprintf(' %s %s', $divider, $current); }
    return $title;
}


/**
 * Set meta datas
 * 
 * @param string $title 
 * @param string $desc 
 * @param string $keywords 
 * @return void
*/
protected function setMeta($title='', $desc = '', $keywords='')
{
   View::setMeta($title, $desc, $keywords);
}


/**
* View render
*
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
 * Get Json Encoding datas
 * 
 * 
 * @param array $response 
 * @return void
*/
public function json($response=[])
{
    $this->response->withHeader([
        "Access-Control-Allow-Origin: *",
        "Content-Type: application/json; charset=UTF-8"
    ]);
    $this->response->setCode(200);
    echo $this->response->asJson($response); 
    
    /*
    $status = $this->response->asJson($response); 
    exit($status);
    */
    exit;
}


/**
 * Do some action on constructor
 * 
 * @return void
*/
private function onConstructor()
{
   $this->addLayout();
}


/**
* Add layout
* 
* @return mixed
*/
protected function addLayout()
{
   if(!$this->layout)
   {
     $layout = false; 
   }else{ 
       if(Config::get('view.layout') !== '')
       {
            $this->layout = Config::get('view.layout');
       }
       $layout = 'layouts/'. $this->layout;
   }
   $this->view->setLayout($layout);
}


}