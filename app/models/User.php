<?php 
namespace app\models;


/**
 * @package app\models\User
*/ 
class User extends  BaseModel
{

	  
/**
* @var string $table
*/
protected static $table = 'users';

/**
 * @var array $fillable
*/
protected $fillable = [
	'username', 'password', 'role'
];

}