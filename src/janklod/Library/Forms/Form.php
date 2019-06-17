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
* Type fields container
* @const array
*/
const MASK_FORM = [
'open'     => '<form %s>', 
'full'     => '<form %s>%s</form>',
'label'    => '<label for="%s">%s</label>',
'input'    => '<input type="%s"%s>',
'select'   => '<select name="%s">%s</select>',
'textarea' => '<textarea %s>%s</textarea>',
'option'   => '<option value="%s">%s</option>',
'button'   => '<button type="%s"%s>%s</button>',
// 'surround' => '<%s>%s</%s>'
];  


/**
* @var array  $data
* @var array  $builders
*/
protected $data = [];
protected $builders = [];
protected $output = '';


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
 * @param string $id
 * @return string
*/
protected function label($label, $id='')
{
    $output = '';
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
 * Open form building
 * 
 * @param array $data
 * @return void
*/
public function open($data = [])
{
     ob_start();
     $this->output  = '<!DOCTYPE html>'.PHP_EOL;
     $this->output .= sprintf('<form %s>', 
        $this->attributes($data)
     );
     $this->output .= PHP_EOL;
}



/**
 * Input
 * 
 * @param array  $attributes
 * @param string $type 
 * @param string $label 
 * @return void
*/
public function input($attributes = [], $type='text', $label='')
{
     $id = $attributes['id'] ?? null;
     $this->output .= $this->label($label, $id);
     $this->output .= sprintf(
        '<input type="%s"%s>', $type, $this->attributes($attributes)
     );
     $this->output .= PHP_EOL;
}


/**
* Generate field type hidden
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
* Get input type file
* @param array $attributes 
* @return void
*/
public function file($attributes = [], $label = '')
{
    $this->output .= $this->input($attributes, 'file', $label);
}


/**
 * Generate input field type textarea
 * 
 * @param array $attributes 
 * @param string $label 
 * @param string $value 
 * @return void
*/
public function textarea($attributes = [], $label = '', $value = '')
{
      $this->output .= sprintf(
       '<textarea %s>%s</textarea>', 
       $this->attributes($attributes),   
       $value
      );
      $this->output .= PHP_EOL;
}


/**
* Generate input field type button
* 
* @param array $attributes 
* @param string $label 
* @param string $type 
* @return void
*/
public function button($attributes = [], $label = '', $type = 'button')
{
      $this->output .= sprintf(
       '<button type="%s"%s>%s</button>', 
       $type,
       $this->attributes($attributes),  
       $label 
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
     
}


/**
 * Close builing inputs
 * 
 * @return string
*/
public function close()
{
	 $this->output .= '</form>';
     ob_get_clean(); 
     echo $this->output;
}


/**
 * Print out
 * 
 * @return void
 */
public function __toString()
{
    return $this->close();
}


public function output()
{
   debug($this->builders);
}




}