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
      * @var \JK\Template\View $view
      * @var \JK\Http\Request $request
      * @var string $layout
      * @var array $data
      * @var string $autoview 
      * [ set automatically view by using controller and action ]
     */
     protected $app;
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
           $this->app = $app;
           $this->view = $app->view;

           // debug($this->view);
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
           if($this->layout === false)
           {
               $layout = false;
           }else{
             
               $layout = $this->layout ?: \Config::get('view.layout');
           }
           $this->view->setLayout($layout);
           (new ViewAdapter($this->view))->render();
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