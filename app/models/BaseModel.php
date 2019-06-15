<?php 
namespace app\models;


use JK\ORM\Model;


/**
 * @package app\models\User
*/ 
class BaseModel extends  Model
{
    public function __construct()
    {
    	 parent::__construct();
    }
}