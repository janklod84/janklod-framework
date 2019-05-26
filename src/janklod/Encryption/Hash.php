<?php 
namespace JK\Encryption;


/**
 * @package JK\Encryption\Hash 
*/ 
class Hash 
{
		 
/**
* Make hash
* @var $string, $salt
* @return string
**/
public static function make($algo = 'sha256', $string, $salt ='')
{
     return hash($algo, $string . $salt);
}

 
/**
* Random Salt
* @var $length
* @return string
**/
public static function salt($length)
{   
    return random_bytes($length);
}
 

/**
  * Check Unique ID
  * @return mixed
**/
public static function unique()
{
   return self::make(uniqid());
}
 
 
/**
* @ hash password 
*/
public static function password($char='', $type=PASSWORD_DEFAULT)
{
   return password_hash($char, $type); 
}
     
}