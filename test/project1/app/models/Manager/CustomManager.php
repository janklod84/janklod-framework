<?php 
namespace app\models\Manager;


use JK\Database\Model;

/**
 * @package app\models\Manager\CustomManager 
*/ 
abstract class CustomManager extends Model
{
	 
    /**
     * Constuctor
     * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }
}