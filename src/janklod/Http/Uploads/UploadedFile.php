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
	   * @param mixed $key
	   * @return void
	  */
	  public function __construct($key = null)
	  {
            $this->files = $_FILES;
	  }
}