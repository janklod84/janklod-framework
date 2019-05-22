<?php 
namespace JK\Http;


/**
 * @package JK\Http\UploadedFile 
*/ 
class UploadedFile 
{
	  
      /**
       * @var array $files
      */
	  private $files = [];


	  /**
	   * Constructor
	   * @param array $files 
	   * @return void
	  */
	  public function __construct($files)
	  {
            $this->files = $files;
	  }
}