<?php 
namespace JK\FileSystem;




/**
 * @package JK\FileSystem\File 
*/ 
class File 
{
      
/**
* separator for windows / lunix ..
* @const string
*/
const DS = DIRECTORY_SEPARATOR;



/**
* root file
* @var string
*/
private $root;




/**
* Constructor
* Ex: $file = new File(__DIR__);
* @param string $root [ it's the root directory of file ]
* @return void
* @throws FileException
*/
public function __construct(string $root)
{
   $this->root = trim($root, '/');
}


/**
* Determine wether the given file path exists
* 
* Ex: (new File(__DIR__))->exists('routes/app.php');
* It'll determine if file __DIR__.'/routes/app.php' exist
* @param string $file
* @return bool
*/
public function exists($file): bool
{
    return file_exists($this->to($file));
}


/**
* Require The given file
*
* Ex: (new File(__DIR__))->call('routes/app.php')
* It'll call file __DIR__.'/routes/app.php'
* @param string $file
* @return bool
*/
public function call($file)
{
    return require_once($this->to($file));
}




/**
 * Generate full path to the given path
 * 
 * Ex: (new File(__DIR__))->to('routes/app.php')
 * It'll return full path  __DIR__.'/routes/app.php'
 * @param string $path
 * @return string
*/
public function to($path)
{
  return $this->fullPath($path);
}


/**
 * Get path info of file
 * Ex: debug($this->file->info('routes/app.php'), true);
 * $file = new File(ROOT); 
 * $file->info('routes/app.php', 'basename');
 * 
 * @param string $path [dirname, basename, extension, filename]
 * @return array
*/
public function info($path, $key='')
{
   $pathInfo = pathinfo($this->to($path));
   if($key !== '')
   {
      return $pathInfo[$key];
   }
   return $pathInfo ?? [];
}


/**
 * Map many files
 * $this->map('routes')
 * $this->map('directory/you/want/to/map')
 * @param string $path 
 * @return array
*/
public function map($path='')
{
   if(strpos($path, '*') === true)
   {
      return;
   }
   $path = trim($path, '/');
   return glob($this->to($path.'/*'));
}


/**
 * Make file
 * @param string $filename
 * @return bool
*/
public function make($filename='')
{
   
}


/**
 * Make folder
 * @param string $foldername
 * @return bool
*/
public function makeFolder($foldername='')
{
    
}



/**
* Prepare path 
* @param string $path 
* @return string
*/
private function fullPath($path)
{
return str_replace('/', self::DS, $this->root) . self::DS. str_replace(
           ['/', '\\'], 
           static::DS, 
           trim($path, '/')
       );
}


}