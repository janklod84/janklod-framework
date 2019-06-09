<?php 
namespace JK\Console\Generators;


/**
 * @package JK\Console\Generators\CustomGenerator
*/ 
abstract class CustomGenerator
{

/**
* Constructor
* 
* @return void
*/
public function __construct()
{

}
  
  
/**
 * Get realpath
 * 
 * @param string $path 
 * @return string
*/
protected function path($path)
{
	$path = trim($path);
	return str_replace('/', DIRECTORY_SEPARATOR, $path);
}


/**
 * Make folder
 * 
 * @param string $directory
 * @return bool
*/
protected function makeFolder($directory='')
{
   if(!is_dir($directory))
   {
       mkdir($directory, 0777, true);
   }
}


/**
 * Make file
 * 
 * Ex: make('modules/controllers', 'HomeController.php');
 * 
 * @param string $directory
 * @param string $filename
 * @return bool
*/
protected function make($directory='', $filename='')
{
   $this->makeFolder($directory);
   $file = sprintf('%s%s%s', $directory, DIRECTORY_SEPARATOR, $filename);
   if(!touch($file))
   {
       exit(sprintf('Can not create file [%s]', $file));
   }
   return $file;
}


/**
 * Put content to file
 * 
 * @param string $filename 
 * @param string $content 
 * @return bool
 * @throws GeneratorException
*/
protected function put($filename='', $content='')
{
   if(!file_put_contents($filename, $content))
   {
       throw new GeneratorException(
        sprintf(
         'Can not put content [%s] to file [%s]', 
         $content, 
         $filename
       ));
   }
   return true;
}
}