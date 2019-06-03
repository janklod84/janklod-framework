<?php 
namespace app\controllers;


use JK\Routing\Controller;


/**
 * @package app\controllers\NotFoundController
*/
class NotFoundController extends Controller
{
    
    /**
     * @var string $layout
    */
	protected $layout = 'error';

 
	/**
	* Action index
	* @return void
	*/
	public function index()
	{
	    return $this->render('errors/404');
	}

}