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
    // to change here later get path more dynamically
    $file  = new \JK\FileSystem\File(
    	realpath(__DIR__)
    );
  
    foreach($file->map('/Functions/*') as $functionPath)
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