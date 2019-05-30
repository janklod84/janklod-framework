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
  // 'ViewPrinter',
  // 'DatabasePrinter',
];


/**
 * @var \JK\Container\ContainerInterface $app
 * @var string $output
*/
private $app; 
private $output = '';



/**
 * @param \JK\Container\ContainerInterface $app 
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
 * Print
 * @return void
*/
public function output($debug = false)
{
   if($debug === true)
   {
       $this->app->response->setHeader('Content-Type: text/html; charset=utf-8');
       $this->output .= '<div style="'. $this->getStyle() . '">';
       $this->output .= $this->mapPrinter('TimingPrinter')->output();
       foreach(self::PRINTERS as $printer)
       {
           $this->output .= $this->mapPrinter($printer)->output();
       }
       $this->output .= '</div>';
       echo $this->output;
   }
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


/**
 * Get style
 * @return string
*/
protected function getStyle()
{
  $style  = 'position:fixed;';
  $style .= 'z-index:9999;';
  $style .= 'bottom:0;';
  $style .= 'left:0;';
  $style .= 'right:0;';
  $style .= 'ligne-height:30px;';
  return $style;
}

}