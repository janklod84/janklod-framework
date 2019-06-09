<?php 
namespace JK\Debug;


use JK\Container\ContainerInterface;
use JK\Debug\Blanks\BlankInterface;

/**
 * @package JK\Debug\Debogger
*/ 
class Debogger
{

   
/**
 * @var \JK\Container\ContainerInterface $app
 * @var array $blanks
 * @var string $output
*/
private $app; 
private $blanks = [
  'RoutingBlank',
  // 'ViewBlank'
];
private $output = '';



/**
 * Constructor 
 * @param \JK\Container\ContainerInterface $app 
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
 * Add blank
 * 
 * @param string $blank
 * @return void
*/
public function addBlank(string $blank)
{
     array_push($this->blanks, $blank);
}


/**
 * Get Blanks
 * 
 * @return array
*/
public function blanks()
{
    return $this->blanks;
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
       $this->output .= $this->debogger('TimingBlank')->output();
       foreach($this->blanks as $blank)
       {
           $this->output .= $this->debogger($blank)->output();
       }
       $this->output .= '</div>';
       echo $this->output;
   }
}


/**
 * Get deb object
 * 
 * @param string $blank 
 * @return \JK\Debug\Blanks\BlankInterface
*/
public function debogger(string $blank): BlankInterface
{
   $blankClass = sprintf('\\JK\\Debug\\Blanks\\%s', $blank);
   if(!class_exists($blankClass))
   {
       exit(
        sprintf('Class <strong>%s</strong> does not exist!', $blankClass)
      );
   }
   return new $blankClass($this->app);
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