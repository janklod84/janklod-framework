<?php 
namespace JK\Http\Uploads;

use JK\Collections\Collection;



/**
 * @package JK\Http\Uploads\UploadedFile 
*/ 
class UploadedFile 
{
	  
      /**
       * @var \JK\Collections\Collection $collection
      */
	  private $collection;


	  /**
	   * Constructor
	   * @param mixed $key
	   * @return void
	  */
	  public function __construct($key = null)
	  {
            $this->collection = new Collection($_FILES);
	  }
}