<?php 
namespace JK\Debug\Printers;


use \Config;


/**
 * @package JK\Debug\Printers\TimingPrinter
*/ 
class TimingPrinter extends CustomPrinter
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
 * Get output
 * @return void
*/
public function outputOLD()
{
    $html  = PHP_EOL;
    $html .= sprintf('<div style="%s">%s</div>', 
        $this->getStyle(), $this->rounder()
     );
    $html .= PHP_EOL;
    return $html;
}

/**
* Get message
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
* @return string
*/
protected function rounder($times = 5)
{
    return round(microtime(true) - JKSTART, $times);
}


/**
 * Get style
 * @return string
*/
protected function getStyle()
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
    return $style;
}

/*
$style  = 'position:fixed';
$style .= 'bottom:0';
$style .= 'background:#900;'; // #007BFF
$style .= 'color:#fff;';
$style .= 'line-height:30px;';
$style .= 'height:30px';
$style .= 'left:0;';
$style .= 'right:0;';
$style .= 'padding-left:10px;';
$style .= 'z-index:9999;';
$style .= 'font-family:Arial;';
return $style;
*/

}