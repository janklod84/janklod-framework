<?php 
namespace JK\Debug;


use JK\Container\ContainerInterface;
use JK\Resource;


/**
 * @package JK\Debug\Reporter
*/ 
class Reporter
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
    if(!empty(Resource::CONFIG['printers']))
    {
        $this->printers = array_merge(
          $this->printers, 
          Resource::CONFIG['printers']
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
       $this->output .= PHP_EOL.'<div style="'. $this->getStyle() . '">';
       $this->output .= $this->printer('TimingBlank')->output();
       foreach($this->printers() as $printer)
       {
           $this->output .= $this->printer($printer)->output();
       }
       $this->output .= '</div>';
       echo $this->output;
   }
}


/**
 * Printer maper
 * @param string $printer 
 * @return \JK\Debug\BlankInterface
*/
public function printer(string $printer): BlankInterface
{
   $printerClass = sprintf('\\JK\\Debug\\Blanks\\%s', $printer);
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