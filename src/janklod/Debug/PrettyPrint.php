<?php 
namespace JK\Debug;


use JK\Container\ContainerInterface;

/**
 * @package JK\Debug\PrettyPrint
*/ 
class PrettyPrint
{
   

/**
 * @var \JK\Container\ContainerInterface $app
 * @var array $data
*/
private $app; 
private $data = [];



/**
 * @param \JK\Container\ContainerInterface $app 
*/
public function __construct(ContainerInterface $app = null)
{
    if(!is_null($app))
    {$this->app = $app;}
}


/**
 * Set data
 * @param string $key 
 * @param mixed $value 
 * @return type
*/
public function data($key, $value)
{
    $this->data[$key] = $value;
}


/**
 * Get data
 * @param string $key 
 * @return mixed
*/
public function get($key)
{
   if(isset($this->data[$key]))
   {
   	  return $this->data[$key];
   }
   return null;
}



/**
* Debogger template
* Show currents view , layout, and controller
* @return void
*/ 
public function output()
{
	// extract($this->data);
    $html  = '<div style="'. $this->getStyle() . '">';
    $html .= '<table class="table table-striped">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th scope="col">Current Controller</th>';
    $html .= '<th scope="col">Current View</th>';
    $html .= '<th scope="col">Current Layout</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
    $html .= '<th scope="row">'; 
    $html .= '<code>'. $this->get('controller') . '</code>'; 
    $html .= '</th>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->get('view') .'</code>'; 
    $html .= '</td>';
    $html .= '<td>'; 
    $html .= '<code>'. $this->get('layout') .'</code>'; 
    $html .= '</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    echo $html;
}


private function getStyle()
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