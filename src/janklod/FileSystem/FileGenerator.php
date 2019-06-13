<?php 
namespace JK\FileSystem;


/**
 * @package JK\FileSystem\FileGenerator
*/ 
class FileGenerator
{

/**
 * @var File     $file       [ File ]
 * @var string   $directory  [ Name of Directory ]
 * @var string   $filename   [ Name of File ]
 * @var string   $content    [ Content ]
 * @var string   $generated  [ Full Path generated File ]
*/
protected $file;
protected $directory = '';
protected $filename  = '';
protected $content   = '';
protected $generated = '';


/**
* Constructor
* 
* @param string $root
* @return void
*/
public function __construct($root)
{
    $this->file = new File($root);
}
  

/**
 * Set Directory
 * 
 * @param string $directory
 * @return void
*/
public function setFolder($directory='')
{
     $this->directory = $directory;
}


/**
 * Get Directory
 * 
 * @return string
*/
public function folder()
{
	return $this->directory;
}

/**
 * Set filename
 * 
 * @param string $filename 
 * @return void
*/
public function setFilename($filename='')
{
     $this->filename = $filename;
}


/**
 * Get Filename
 * @return string
*/
public function filename()
{
	return $this->filename;
}


/**
 * Set content
 * 
 * @param string $content 
 * @return void
*/
public function setContent($content='')
{
     $this->content = $content;
}


/**
 * Get content
 * 
 * @return string
*/
public function content()
{
    return $this->content;
}


/**
 * Generate file
 * 
 * @return void
*/
public function put()
{
     $this->generated = $this->file->make(
         $this->directory, 
         $this->filename
     );
     return $this->file->put($this->generated, $this->content);
}



/**
 * Full name generated File
 * 
 * @return string
*/
public function generated()
{
	if($this->generated === '')
	{
		 exit('No File Generated!');
	}
	return $this->generated;
}


}