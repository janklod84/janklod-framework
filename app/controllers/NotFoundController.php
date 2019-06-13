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
	* Action page 404
	* @return void
	*/
	public function page404()
	{
		$this->setMeta('Страница не найдена!');
	    return $this->render('errors/404');
	}

}