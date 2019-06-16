<?php 
namespace JK\FileSystem\Contracts;

/**
 * @package JK\FileSystem\Contracts\FileInterface 
*/
interface FileInterface 
{
     
/**
* return full path of file
* 
* @param  $path 
* @return string
*/
public function to($path);
}