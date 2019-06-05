<?php 
namespace JK\Debug\Blanks;

use JK\Debug\BlankInterface;

/**
 * @package JK\Debug\Blanks\CustomBlank 
*/ 
abstract class CustomBlank implements BlankInterface 
{

      /**
      * @param \JK\Container\Container $app 
      * @param \JK\FileSystem\File $file
      */
      protected $app;
      protected $file;


      /**
      * Constuctor
      * @param \JK\Container\Container $app 
      * @return void
      */
      public function __construct($app)
      {
          $this->app = $app;
          $this->file = $app->file;
      }

      /**
      * Get output
      * @return string
      */
      abstract public function output();
      
}