<?php 
namespace JK\Helper;

/**
 * @package JK\Helper\Logger 
*/ 
class Logger 
{
	   
	    /**
	     * @var \JK\FileSystem\File
	    */
	    private $file;


	    /**
	     * Constructor
	     * @param string $path
	     * @return void
	    */
	    public function __construct($root = '')
	    {
	    	  $this->file = new File($root);
	    }

        
        /**
         * Log file
         * @param string $content 
         * @param string $path 
         * @return void
        */
	    public function put($content, $path = '')
	    {
	    	 $filename = $this->file->to($path);
	    	 file_put_contents($filename, $content);
	    }
}