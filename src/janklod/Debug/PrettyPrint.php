<?php 
namespace JK\Debug;


use JK\Container\ContainerInterface;
use JK\Capture;


/**
 * @package JK\Debug\PrettyPrint
*/ 
class PrettyPrint
{
   
/**
 * @var \JK\Container\ContainerInterface $app
 * @var array $printers
 * @var string $output
*/
private $app; 
private $printers = [];
private $output = '';



/**
 * @param \JK\Container\ContainerInterface $app 
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
 * Add printer name 
 * [ \App\Blank\TestPrinter, \App\Blank\TestPrinter::class ]
 * @param string $printer 
 * @return void
*/
public function addPrinter(string $printer)
{
     array_push($this->printers, $printer);
}


/**
 * Get printers
 * @return array
*/
public function printers()
{
    if(!empty(Capture::SRC['printers']))
    {
        $this->printers = array_merge(
          $this->printers, 
          Capture::SRC['printers']
        );
    }
    return $this->printers;
}


/**
 * Print all output
 * @param bool $debug
 * @return void
*/
public function output($debug = false)
{
   if($debug === true)
   {
       $this->app->response->setHeader('Content-Type: text/html; charset=utf-8');
       $this->output .= '<div style="'. $this->getStyle() . '">';
       $this->output .= $this->mapPrinter('TimingPrinter')->output();
       foreach($this->printers() as $printer)
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