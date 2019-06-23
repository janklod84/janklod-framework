<?php 
namespace JK\Debug\Blanks;


use \Config;


/**
 * @package JK\Debug\Blanks\TimingBlank
*/ 
class TimingBlank extends CustomBlank
{
      
/**
 * Get output
 * @return void
*/
public function output()
{
    if($showMsg = $this->getMessage())
    {
        $html  = PHP_EOL;
        $html .= sprintf('<div style="%s">%s</div>', 
            $this->getStyle(),
            sprintf($showMsg, $this->rounder())
         );
        $html .= PHP_EOL;
        return $html;
    }
}



/**
* Get message
* 
* @param string $code 
* @return mixed
*/
public function getMessage($code = null)
{
   $code = $code ?: Config::get('app.language');
   $path = 'app/lang/'. mb_strtolower($code) .'/microtimer.php';
   if($this->file->exists($path))
   {
        $message = $this->file->call($path);
        if(isset($message['msg']))
        {
           return $message['msg'];
        }
   }
   return false;
}


/**
* Round value
* @param int $times [How many times]
* @param float $start
* @return string
*/
public function rounder($times = 5, float $start=null)
{
    $start = $start ?: JKSTART;
    return 1000 * round(microtime(true) - $start, $times);
}


/**
 * Get style
 * @param string $styliser
 * @return string
*/
public function getStyle($styliser=null)
{
    $style  = 'background:#900;';
    $style .= 'color:#fff;';
    $style .= 'line-height:30px;';
    $style .= 'height:30px';
    $style .= 'left:0;';
    $style .= 'right:0;';
    $style .= 'padding-left:10px;';
    $style .= 'z-index:9999;';
    $style .= 'font-family:Arial;';
    return $styliser ?: $style;
}


}