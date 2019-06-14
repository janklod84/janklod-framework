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
*/
protected $file;
protected $directory = '';
protected $filename  = '';
protected $content   = '';



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
    return $this->file->generator(
        $this->directory, 
        $this->filename, 
        $this->content
    );
}


/**
 * Get full path generated file
 * 
 * @return string
*/
public function path()
{
   $to = sprintf('%s/%s', $this->directory, $this->filename);
   if($this->file->exists($to))
   {
      return $this->file->to($to);
   }
   return false;
}


/**
 * Remove generated file
 * 
 * @return bool
*/
public function remove()
{
    if($path = $this->path())
    {
        return $this->file->remove($path);
    }
}

}