<?php 
namespace JK\Http\Uploads;

use JK\Collections\Collection;



/**
 * @package JK\Http\Uploads\UploadedFile 
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
	  public function __construct($files = [])
	  {
            $this->files = $files;
	  }
}