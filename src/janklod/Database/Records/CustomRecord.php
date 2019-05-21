<?php 
namespace JK\Database\Records;


use JK\Database\Model;

/**
 * @package JK\Database\Records\CustomRecord 
*/ 
class CustomRecord  extends Model
{
   
   /**
     * @var string $table
   */
   protected $table;


	/**
     * Constructor
     * @param string $table
     * @return void
    */
    public function __construct($table = null)
    {
		    parent::__construct();
        $this->table = $table;
    }

}