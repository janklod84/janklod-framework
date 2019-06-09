<?php 
namespace JK\Helper;

/**
 * @package JK\Helper\FileGenerator 
*/ 
trait FileGenerator 
{


/**
 * Get realpath
 * 
 * @param string $path 
 * @return string
*/
public function path($path)
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
public function makeFolder($directory='')
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
public function make($directory='', $filename='')
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
 * @throws FileException
*/
public function put($filename='', $content='')
{
   if(!file_put_contents($filename, $content))
   {
       throw new FileException(
        sprintf(
         'Can not put content [%s] to file [%s]', 
         $content, 
         $filename
       ));
   }
   return true;
}
}