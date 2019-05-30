<?php 
namespace JK\Debug;


use JK\Container\ContainerInterface;

/**
 * @package JK\Debug\PrettyPrint
*/ 
class PrettyPrint
{
   
// all availables printers
const PRINTERS = [
  'RoutingPrinter',
  'ViewPrinter',
];


/**
 * @var \JK\Container\ContainerInterface $app
 * @var string $output
*/
private $app; 
private $output = '';
// private $output = '<div style="">';




/**
 * @param \JK\Container\ContainerInterface $app 
*/
public function __construct($app = null)
{
    if(!is_null($app))
    {$this->app = $app;}
}


/**
 * Print
 * @return void
*/
public function output()
{
   foreach(self::PRINTERS as $printer)
   {
       $this->output .= $this->mapPrinter($printer)->output();
   }
   echo $this->output;
}


/**
 * Printer maper
 * @param PrinterInterface $printer 
 * @return \JK\Debug\PrinterInterface
*/
public function mapPrinter(string $printer): PrinterInterface
{
   $printerClass = sprintf('\\JK\\Debug\\Printers\\%s', $printer);
   if(!class_exists($printerClass))
   {
       exit(
        sprintf('Class <strong>%s</strong> does not exist!', $printerClass)
      );
   }
   return new $printerClass($this->app);
}


}