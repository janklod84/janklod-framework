<?php 
namespace app\controllers\site;

/**
 * SiteController class [ Base controller frontend part ]
 * @package app\controllers\site\HomeController 
*/
class HomeController extends SiteController 
{
    
    /**
     * Action index
     * @return void
    */
    public function index()
    {
    	 $this->render('home/index');
    }
}
