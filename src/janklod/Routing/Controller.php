<?php 
namespace JK\Routing;


use \Config;


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
     $this->beforeRender();
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
     $this->app->merge([
        'current.view.path'   => $this->view->viewPath(),
        'current.layout.path' => $this->view->layoutPath()
     ]);
}


/**
 * Get Json Encoding datas
 * 
 * Ex: 
 *  $this->json([
 *      'Bonjour les amis' => 'Comment ca va ?', 
 *      'error' => false,
 *      'status' => 'OK'
 *   ]);
 * {"Bonjour les amis":"Comment ca va ?","error":false,"status":"OK"}
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
      exit;
}


/**
 * Do action before render
 * @return void
*/
private function beforeRender()
{
     \Asset::map(
        Config::get('asset.css'),
        Config::get('asset.js'),
        base_url()
     );
     
     $this->view->partialDir(Config::get('view.partial'));
     $this->view->setLayout(
        $this->mapLayout()
     );
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


}