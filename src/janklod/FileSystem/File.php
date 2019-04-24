<?php 
namespace JK;


use \Exception;


/**
 * @package JK\File 
*/ 
class File 
{
      
       /**
        * separator for windows / lunix ..
        * @const string
       */
       const DS = DIRECTORY_SEPARATOR;



       /**
        * root file
        * @var string
       */
       private $root;
       
       
       

       /**
        * Constructor
        * Ex: $file = new File(__DIR__);
        * @param string $root [ it's the root directory of file ]
        * @return void
       */
	   public function __construct($root = null)
	   {
	   	       if(is_null($root))
	   	       {
	   	       	   exit('Check please root directory');
	   	       }
               $this->root = $root;
	   }

       
       /**
        * 
        * @param string $path 
        * @return string
       */
	   public function to($path)
	   {
           echo $path;
	   }
}