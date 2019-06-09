<?php 
namespace JK\Console\Generators;

use JK\Console\Exceptions;


/**
 * @package JK\Console\Generators\CustomGenerator
*/ 
abstract class CustomGenerator
{

/**
 * @var \JK\Console\IO\InputInterface $input
 * @var string $basePath
*/
protected $input;
protected $root = '';


/**
* Constructor
* 
* @param array $arguments
* @return void
*/
public function __construct($input)
{
    $this->input = $input;
    if(defined('ROOT') && ROOT)
    {
        $this->root = trim(ROOT, '/');
    }
}
  

/**
 * Get input argument
 * 
 * Ex: $this->input(1);
 * echo $this->input->argument(2). "\n";
 * 
 * @param type $key 
 * @return type
*/
public function input($key)
{
   return $this->input->argument($key);
}


/**
 * Get realpath
 * 
 * @param string $path 
 * @return string
*/
protected function basePath($path=null)
{
	  if(!is_null($path))
    {
       $this->root = $this->root . '/'. trim($path, '/');
       return str_replace('/', DIRECTORY_SEPARATOR, $this->root);
    }
    return $this->root;
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
   $file = sprintf('%s%s%s', 
   $directory, 
   DIRECTORY_SEPARATOR, 
   $filename
   );
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
      exit(
       sprintf(
         'Can not put content [%s] to file [%s]', 
         $content, 
         $filename
       )
      );
      /*
       throw new GeneratorException(
        sprintf(
         'Can not put content [%s] to file [%s]', 
         $content, 
         $filename
       ));
       */
   }
   return true;
}


/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function generate();


/**
 * Blank of custom to generate
 * 
 * @return string
*/
abstract public function blank();
}