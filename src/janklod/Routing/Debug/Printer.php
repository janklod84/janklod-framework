<?php 
namespace JK\Routing\Debug;

/**
 * @package JK\Routing\Debug\Printer
*/ 
class Printer
{
   

/**
 * @var array $data
*/
private $data = [];


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
    $html .= '<th scope="col">Current controller</th>';
    $html .= '<th scope="col">Current view path</th>';
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
   $style .= 'bottom:0;';
   $style .= 'left:0;';
   $style .= 'right:0;';
   $style .= 'ligne-height:30px;';
   return $style;
}


}