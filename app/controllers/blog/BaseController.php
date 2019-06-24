<?php 
namespace app\controllers\blog;


use JK\Routing\Controller;
use \Auth;

/**
 * Base controller of Blog
 * 
 * @package app\controllers\blog\BaseController 
*/ 
class BaseController extends Controller
{

protected $validation;
protected $errors = [];


/**
* Constructor
* @param \JK\Container\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
    parent::__construct($app);
    $this->validation->addTranslation(lang('ru', 'validation'));
}

}