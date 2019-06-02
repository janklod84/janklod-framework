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
 * Determine if has option param
 * @param string $group
 * @param string $key 
 * @return bool
*/
public static function hasItem($group, $key)
{
    if(self::hasOption($group))
    {
       $parent = self::retrieveGroup($group);
       return array_key_exists($key, $parent);
    }
}


/**
 * Retrieve Group
 * @param string $group
 * @return mixed
*/
public static function retrieveGroup($group)
{
    if(self::hasOption($group))
    {
         return self::$options[$group];
    }

    return null;
}

/**
 * Retrieve item
 * @param string $group
 * @param string $item 
 * @return mixed
*/
public static function retrieveItem($group, $item='')
{
     if(self::hasItem($group, $item))
     {
         return self::$options[$group][$item];
     }
     return null;
}
     

/**
 * Retrieve prefix item
 * @param string $key 
 * @return string
*/
public static function prefix($key)
{
    return self::retrieveItem('prefix', $key);
}

/**
 * Determine if has prefix item
 * @param string $key 
 * @return string
*/
public static function hasPrefix($key)
{
    return self::hasItem('prefix', $key);
}


/**
 * Retrieve name of module
 * @return string
*/
public static function module()
{
   return self::retrieveGroup('module');
}


/**
 * Retrieve middleware
 * @return mixed
*/
public static function middleware()
{
   return self::retrieveGroup('middleware');
}

}