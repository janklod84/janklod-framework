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
* Load config from file
* @param string $parsed
* @return self
*/
public static function load($parsed='')
{
   if($parsed)
   {
        self::$group = $parsed;
        if(strpos($parsed, '.') !== false)
        {
            $exp = explode('.', $parsed);
            self::$group = $exp[0];
            self::$item  = $exp[1];
        }

        self::$configPath .= '/' . self::$group . '.php';
        if(is_file(self::$configPath))
        {
            self::saveFile();
        }

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
 * Determine if has group stored
 * @param string $group 
 * @return bool
*/
public static function isStored($group='')
{
     return array_key_exists($group, self::$stored);
}



/**
 * Determine if has item
 * @param string $item 
 * @return bool
*/
public static function hasChild($item)
{
    return array_key_exists($item, self::$stored[self::$group]);
}


/**
 * Retrieve item
 * @param string $item 
 * @return mixed
*/
public static function retrieveItem($item='')
{
     return self::$stored[self::$group][$item];
}


/**
 * Retrieve group
 * @param string $item 
 * @return mixed
*/
public static function retrieveGroup()
{
     return self::$stored[self::$group];
}



/**
 * Save data file in container
 * @return 
*/
private static function saveFile()
{
     self::store([self::$group => require(self::$configPath)]);
}


}