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
      * Set data
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
      * @param array $data 
      * @return mixed
     */
     protected function render($view, $data = [])
     {
         $viewObj = new View();
         $viewObj->segment($view);
         $viewObj->data($data);
         $viewObj->layout($this->layout);
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
         return $this->request->method() === 'POST';
     }


     /**
      * Determine if request method is GET
      * @return bool
     */
     protected function isGet(): bool
     {
         return $this->request->method() === 'GET';
     }


     /**
      * Determine if request method by AJAX
      * @return bool
     */
     protected function isAjax(): bool
     {
     	   $xhr = $this->request->server('HTTP_X_REQUESTED_WITH');
         return $xhr === 'XMLHttpRequest';
     }


}