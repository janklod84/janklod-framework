<?php 
namespace JK\Routing;


use \Config;
use \HTML;
use \View;
use JK\Http\Request;


/**
 * @package JK\Routing\Controller
*/
abstract class Controller 
{
     
/**
* @var \JK\DI\ContainerInterface $app
* @var \JK\Template\View $view
* @var \JK\Http\Request $request
* @var \JK\Http\Response $response
* @var string $layout
*/
protected $app;
protected $view;
protected $request;
protected $response;
protected $layout = 'default';


/**
* Constructor
* 
* @param \JK\DI\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     $this->app      = $app;
     $this->view     = $app->view;
     $this->request  = Request::capture();
     $this->response = $app->response;
     $this->validation = $this->app->validation;
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
 * Get Cache instance
 * 
 * Ex:  $this->cache()->set('key1', 'value1');
 * Ex:  $this->cache()->get('key1');
 * Ex:  $this->cache()->delete('key1');
 * 
 * @return Current Object cache
 */
public function cache()
{
   return $this->app->cache;
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