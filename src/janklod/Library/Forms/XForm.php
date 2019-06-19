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
protected $output = PHP_EOL;
protected $surround = '';
protected $closed = false;



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
 * @param  string $action 
 * @param  string $method 
 * @param  array $options 
 * @return void
 */
public function open($action='/', $method='POST', $options = [])
{
     ob_start();
     $this->output = sprintf('<form action="%s" method="%s"%s>', 
        $action,  
        $method,
        $this->attributes($options)
     );
     $this->output .= PHP_EOL;
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
     $this->output .= sprintf(
        '%s<input type="%s"%s>', 
        $this->label($label, $attributes),
        $type, 
        $this->attributes($attributes)
     );
     $this->output .= PHP_EOL;
}



/**
* Input Password
* 
* @param array  $attributes 
* @param string $label
* @return void
*/
public function password($attributes = [], $label='')
{
     $this->output .= $this->input($attributes, 'password', $label);
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
* TO FIX!!!
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
 * Add content in form
 * 
 * @param array|string $content 
 * @return 
*/
public function html($content=null)
{
     if(is_array($content)) 
     { $this->output .= implode(PHP_EOL, $content); }
     $this->output .= $content . PHP_EOL;
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




/**
* Surround field
* NO FINISH!
* 
* @param string $data 
* @return string
*/
protected function surround($data, $attributes = [])
{
     if($this->surround)
     {
         $attr = $this->attributes($attributes);
         $html = sprintf("<{$this->surround} %s>", $attr). PHP_EOL;
         $html .= $data;
         $html .= "</{$this->surround}>". PHP_EOL;

     }else{

         return $data;
     }
}


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
 * @param string $content 
 * @param string $attributes
 * @return string
*/
protected function label($content, $attributes)
{
    $output = '';
    $id = $attributes['id'] ?? null;
    if($content)
    {
        $output .= sprintf(
        '<label for="%s">%s</label>',   
        $id, 
        $content
        ).PHP_EOL;
    }
    return $output;
}


/**
 * Style inline
 * 
 * @param array $attributes 
 * @return string
*/
public function styliser($attributes=[])
{
      $style = '';
      foreach($attributes as $property => $value)
      {
          $style .= sprintf('%s:%s;', $property, $value);
      }
      return sprintf('style="%s"', $style);
}


}