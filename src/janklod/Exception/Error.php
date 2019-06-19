<?php 
namespace JK\Exception;


use JK\Exception\Contracts\ErrorInterface;


/**
 * @param JK\Exception\Error
*/
class Error
{
 
 /**
  * @var ErrorInterface $error
 */
 private static $error;


 /**
  * Capture errors
  * 
  * @param ErrorInterface $error 
  * @param mixed $handler 
  * @return void
  */
 public static function capture(ErrorInterface $error)
 {
 	   self::$error = $error;
     self::$error->setHandler();
     self::$error->register();
     return new static;
 }
}