<?php 
namespace JK\FileSystem;



/**
 * @package JK\FileSystem\FileLogger 
*/ 
class FileLogger 
{
	   
/**
* @var \JK\FileSystem\File
*/
protected $file;


/**
* Constructor
* @param string $path
* @return void
*/
protected function __construct($root = '')
{
    $this->file = new File($root);
}


/**
* Put content in file
* @param string $content 
* @param string $path 
* @return void
*/
public function put($content, $path = '')
{
  $filename = $this->file->to($path);
  if(file_put_contents($filename, $content))
  {
	  return true;
  }
  return false;
}
}