<?php 
namespace JK\DI;

use \ReflectionClass;
use \Exception;


/**
 * @package JK\DI\Reflection 
*/ 
class Reflection
{
       
/**
* @var \Reflection
*/
private $reflection;


/**
* @var mixed $arguments [ arguments of class ]
*/
private $arguments = null;


/**
* Constructor
* @param mixed $parsed 
* @return void
* @throws \Exception
*/
public function __construct($parsed)
{
     if(is_object($parsed)) 
     { return $parsed; }
     if(is_string($parsed) && !class_exists($parsed))
     {
           throw new Exception('class <strong>'. $parsed .'</strong> does not exit');

     }
     $this->reflection = new ReflectionClass($parsed);
}


/**
* Get name reflected class
* @return string
*/
public function name()
{
    return $this->reflection->getName();
}


/**
* Set class arguments
* @param mixed $arguments 
* @return $this
*/
public function setArguments($arguments = null)
{
	    $this->arguments = $arguments;
	    return $this;
}


/**
* Create new object with or without arguments
* @return object
*/
public function createNewObject()
{
     if($this->reflection->isInstantiable())
     {
     	    if(is_null($this->arguments))
          {
               $obj = $this->reflection->newInstance();

          }else{
        
	            if($this->constructor())
	            {
	            	     if(!is_array($this->arguments))
	                   {
	                         $this->arguments = [$this->arguments];
	                   }
            
                     $obj = $this->reflection->newInstanceArgs($this->arguments);
	            }
          }

          return $obj;

     }else{

     	   exit('This <strong> ' . $this->name() . ' does not instantiable!');
     }
}



/**
* Determine constructor reflected class
* @return bool
*/
public function constructor()
{
    return $this->reflection->getConstructor();
}


/**
* Get class params
* @return array
*/
public function parameters()
{
    return $this->constructor()->getParameters();
}

}