<?php 
namespace JK\Routing\Route\Controls;


/**
 * @package JK\Routing\Route\Controls\OptionControl 
*/ 
class OptionControl 
{


/**
* @var array $options
*/
private static $options = [];



# OPTIONS CONTROL
/**
 * Push Options
 * @param array $options 
 * @return void
*/
public static function addOptions($options = [])
{
      self::$options = array_merge(self::$options, $options);
}


/**
 * Add Option
 * @param string $key 
 * @param string $value 
 * @return void
*/
public static function addOption($key, $value)
{
      self::$options[$key] = $value;
}


/**
 * remove Option item
 * @param string $key  
 * @return void
*/
public static function removeOption($key)
{
     if(self::hasOption($key))
     {
         unset(self::$options[$key]);
     }
}



/**
 * Clean all options
 * @return void
*/
public static function cleanOptions()
{
      self::$options = [];
}


/**
 * Determine if has option param
 * @param string $key 
 * @return bool
*/
public static function hasOption($key)
{
    return array_key_exists($key, self::$options);
}


/**
* Get option
* @param string $parsed 
* @return mixed
*/
public static function getOption($parsed='')
{
    if($parsed)
    {
          $part = explode('.', $parsed);
          $parent = $part[0];
          $result = null;

            if(self::hasOption($parent))
            {
                $result = self::$options[$parent];
                foreach($part as $item)
                {
                      if(isset($result[$item]))
                      {
                          $result = $result[$item];
                      }
                }
            }

        return $result;
    }
} 

	     

}