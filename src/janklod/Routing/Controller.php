<?php 
namespace JK\Routing;


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
      * View render
      * @param string $view 
      * @param array $data 
      * @return mixed
     */
     protected function render($view, $data = [])
     {

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