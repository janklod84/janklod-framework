<?php 
namespace JK\Routing;


use JK\Template\{
   View,
   ViewAdapter
};


/**
 * @package 
*/
abstract class Controller 
{
       
     /**
      * @var \JK\DI\ContainerInterface $app
      * @var \JK\Http\Request $request
      * @var string $layout
      * @var array $data
     */
     protected $app;
     protected $request;
     protected $layout;
     protected $data = [];

       
     /**
      * Constructor
      * @param \JK\DI\ContainerInterface $app 
      * @return void
     */
	   public function __construct($app)
	   {
           $this->app = $app;
           $this->request = $app->get('request');
	   }

       
    
     /**
      * Do something before calling action
      * @return void
     */
     public function before() {}


     /**
      * Do something after calling action
      * @return void
     */
     public function after() {}


     /**
      * Set data
      * @param array $data 
      * @return void
     */
     protected function set($data = [])
     {
          $this->data = $data;
     }



     /**
      * View render
      * @param string $view 
      * @param array $data 
      * @return mixed
     */
     protected function render($view, $data = [])
     {
         $this->data = array_merge($this->data, $data);
         $viewObj = new View(ROOT .'app/views');
         $viewObj->setPath($view);
         $viewObj->setData($this->data);
         $viewObj->setLayout($this->layout);
         (new ViewAdapter($viewObj))->render();
     }

     
     /**
      * 
      * @param string $name 
      * @return void
     */
     protected function loadModel($name)
     {
         // $this->load->model($name);
     }


     /**
      * Determine if request method is POST
      * @return bool
     */
     protected function isPost(): bool
     {
         return $this->request->isPost();
     }


     /**
      * Determine if request method is GET
      * @return bool
     */
     protected function isGet(): bool
     {
         return $this->request->isGet();
     }


     /**
      * Determine if request method by AJAX
      * @return bool
     */
     protected function isAjax(): bool
     {
     	   return $this->request->isAjax();
     }


}