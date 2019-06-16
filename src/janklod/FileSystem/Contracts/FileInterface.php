<?php 
namespace JK\FileSystem\Contracts;

/**
 * @package JK\FileSystem\Contracts\FileInterface 
*/
interface FileInterface 
{


/**
 * Determine if current file exist
 * 
 * @param string $path
 * @return bool
*/
public function exists($path);



/**
* return full path of file
* 
* @param  $path 
* @return string
*/
public function to($path);

}