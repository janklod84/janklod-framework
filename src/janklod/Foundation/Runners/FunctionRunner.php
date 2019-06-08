<?php 
namespace JK\Foundation\Runners;

/**
 * @package JK\Foundation\Runners\FunctionRunner 
*/ 
class FunctionRunner extends CustomRunner 
{


/**
* Initialize functions
* 
* @return void
*/
public function init()
{
    // $maskPath  = __DIR__.'/../Functions/*';
    $maskPath  = '';
    
    echo '<pre>';
    print_r($this->app->file->to('src/janklod/Functions/*')); 
    echo '</pre>';
    die;

    foreach(glob($maskPath) as $functionPath)
    {
           if(is_file($functionPath))
           {
                if(pathinfo($functionPath)['extension'] === 'php')
                {
                     if($path = realpath($functionPath))
                     {
                         if(require_once($path))
                         {
                             self::$initialized['functions'][] = $path;
                         }
                     }
                }   
           }
    }

}


}