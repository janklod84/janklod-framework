<?php 
namespace JK\Debug\Printers;

use JK\Debug\PrinterInterface;

/**
 * @package JK\Debug\Printers\CustomPrinter 
*/ 
abstract class CustomPrinter implements PrinterInterface 
{

      /**
      * @param \JK\Container\Container $app 
      */
      protected $app;


      /**
      * Constuctor
      * @param \JK\Container\Container $app 
      * @return void
      */
      public function __construct($app)
      {
          $this->app = $app;
      }

      /**
      * Get output
      * @return string
      */
      abstract public function output();
      
}