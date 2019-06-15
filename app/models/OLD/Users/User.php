<?php 
namespace app\models;


use JK\ORM\Model;

/**
 * @package app\models\User
*/ 
class User extends  Model
{

	  
/**
* @var string $table
*/
protected static $table = 'users';
protected $fillable = ['test'];


/**
* @var int    $id
* @var string $username
* @var string $password
* @var mixed  $role
*/
/*
public $id;
public $username;
public $password;
public $role = 1;
*/


}