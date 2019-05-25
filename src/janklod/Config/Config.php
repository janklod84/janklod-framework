<?php 
namespace JK\Config;


/**
 * @package JK\Config\Config 
*/ 
class Config 
{
         
/**
* @var array $stored       [ Repository configuation ]
* @var string $configPath
* @var string $group
*/
protected static $stored = [];
protected static $item;
protected static $configPath='';
protected static $group='';


/**
* set config directory path
* @param string
* @return 
*/
public static function directive(string $configPath='')
{
     self::$configPath = $configPath;
}


/**
* Store configuration
* @param array $data 
* @return void
*/
public static function store($data=[])
{
    self::$stored = array_merge(self::$stored, $data);
}


/**
 * Get config
 * @param string $parsed 
 * @return mixed
*/
public static function get($parsed='')
{
    return self::load($parsed);
}


/**
* Load config from file
* @param string $parsed
* @return self
*/
public static function load($parsed='')
{
   if($parsed)
   {
        // Get config part
        self::$group = $parsed;
        self::$item = null;
        if(strpos($parsed, '.') !== false)
        {
            $exp = explode('.', $parsed);
            self::$group = $exp[0];
            self::$item  = $exp[1];
        }
         
        if(self::$configPath !== '')
        {
            $file = self::$configPath . '/' . mb_strtolower(self::$group) . '.php';
            if(is_file($file))
            {
                self::saveFile($file);
            }
        }
        
        // retrieve group or item
        if(self::isStored(self::$group))
        {
             // retrive part
             if(self::hasChild(self::$item))
             {
                  return self::retrieveItem(self::$item);
             }

             return self::retrieveGroup();
        }
   }
}


/**
 * Get all stored configuration
 * @return array
*/
public static function all()
{
    return self::$stored;
}



/**
 * Determine if has group stored
 * @param string $group 
 * @return bool
*/
private static function isStored($group='')
{
     return !empty(self::$stored[$group]);
}



/**
 * Determine if has item
 * @param string $item 
 * @return bool
*/
private static function hasChild($item='')
{
    $finded = array_key_exists(self::$group, self::$stored);
    if(!is_null($item))
    {
        $finded = array_key_exists($item, self::$stored[self::$group]);
    }
    return $finded;
}



/**
 * Retrieve item
 * @param string $item 
 * @return mixed
*/
private static function retrieveItem($item='')
{
     $retrieved = self::$stored[self::$group] ?? '';
     if(!is_null($item))
     {
         $retrieved = self::$stored[self::$group][$item] ?? '';
     }
     return $retrieved;
}


/**
 * Retrieve group
 * @param string $item 
 * @return mixed
*/
private static function retrieveGroup()
{
     return self::$stored[self::$group];
}



/**
 * Save data file in container
 * @param string $file
 * @return void
*/
private static function saveFile($file)
{
  if($path = realpath($file))
  {
      self::store([self::$group => require($path)]);
  }
}



}