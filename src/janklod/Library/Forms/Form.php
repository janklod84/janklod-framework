<?php 
namespace JK\Library\Forms;


use \Exception;


/**
 * class Form
 * 
 * @package JK\Library\Forms\Form
*/ 
class Form 
{



/**
* @var  array   $data
* @var  string  $output
* @var  string  $surround
* @var  bool    $closed
*/
protected $data = [];
protected $output   = PHP_EOL;
protected $surround = '';
protected $closed   = false;


/**
 * Strigify attributes
 * 
 * @param array $attributes 
 * @return string
*/
protected function attributes($attributes=[])
{
   if($attributes)
   {
       $str = '';
       foreach($attributes as $key => $value)
       {
            $str .= sprintf(' %s="%s"', $key, $value);
       }
       return $str;
   }
}


/**
 * Get Label
 * 
 * @param string $label 
 * @param string $attributes
 * @return string
*/
protected function label($label, $attributes)
{
    $output = '';
    $id = $attributes['id'] ?? null;
    if($label)
    {
        $output .= sprintf(
        '<label for="%s">%s</label>',   
        $id, $label
        ).PHP_EOL;
    }
    return $output;
}


/**
 * Surround input
 * 
 * @return void
*/
protected function surround()
{
      //
}


/**
 * Construct
 * 
 * @param array $data 
 * @return void
*/
public function __construct($data=[])
{
	  $this->data = $data;
}


/**
 * Open form
 * 
 * @param array $attributes
 * @return void
*/
public function open($attributes = [])
{
     ob_start();
     $attributes['method'] = $attributes['method'] ?? 'POST';
     $this->output = sprintf('<form %s>', 
        $this->attributes($attributes)
     );
     $this->output .= PHP_EOL;
}


/**
 * Style inline
 * 
 * @param array $attributes 
 * @return string
*/
public function styliser($attributes=[])
{
    $styles = $attributes['style'] ?? [];
    if(is_array($styles) && !empty($styles))
    {
        $style = '';
        foreach($styles as $property => $value)
        {
           $style .= sprintf('%s:%s;', $property, $value);
        }
        // return sprintf('style="%s"', $style);
        $attributes['styles'] = $style;
    }
}


/**
 * Input General
 * 
 * @param array  $attributes
 * @param string $type 
 * @param string $label 
 * @return void
*/
public function input($attributes = [], $type='text', $label='')
{
     $this->output .= $this->label($label, $attributes);
     $this->output .= sprintf(
        '<input type="%s"%s>', $type, $this->attributes($attributes)
     );
     $this->output .= PHP_EOL;
}


/**
* Input Hidden
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public function hidden($attributes = [], $label='')
{
     $this->output .= $this->input($attributes, 'hidden', $label);
}



/**
* Input File
* 
* @param array $attributes 
* @return void
*/
public function file($attributes = [], $label = '')
{
    $this->output .= $this->input($attributes, 'file', $label);
}


/**
 * Textarea
 * 
 * @param array $attributes 
 * @param string $label 
 * @param string $value 
 * @return void
*/
public function textarea($attributes = [], $label = '', $value = '')
{
      $this->output .= $this->label($label, $attributes);
      $this->output .= sprintf(
       '<textarea %s>%s</textarea>', 
       $this->attributes($attributes),   
       $value
      );
      $this->output .= PHP_EOL;
}


/**
 * Select
 * 
 * @param array $attributes 
 * @return void
*/
public function select($attributes = [])
{
   '<select name="%s">%s</select>'. 
   '<option value="%s">%s</option>';
}


/**
 * Submit Input
 * 
 * @param array $attributes
 * @return void
*/
public function inputSubmit($attributes = [])
{
    $this->output .= $this->input($attributes, 'submit', null);
}


/**
* Generate input field type button
* 
* @param array $attributes 
* @param string $value 
* @return void
*/
public function button($attributes = [], $value = '')
{
      $this->output .= sprintf(
       '<button%s>%s</button>', 
       $this->attributes($attributes),  
       $value 
      );
      $this->output .= PHP_EOL;
}


/**
* Generate field type checkbox
* 
* @param array $attributes 
* @param string $label 
* @return void
*/
public function checkBox($attributes = [], $label = '', $checked = 'on')
{
     ($checked == 'on') ? $attributes['checked'] = 'checked' : '';
     $this->output .= $this->input($attributes, 'checkbox', null);
}


/**
 * Close builing inputs
 * 
 * @return string
*/
public function close()
{
	 $this->output .= '</form>'.PHP_EOL;
     ob_get_clean(); 
     echo $this->output;
}




}