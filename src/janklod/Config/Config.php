<?php 
namespace JK\Config;


/**
 * @package JK\Config\Config 
*/ 
class Config 
{
         
/**
* @var array $stored       [ Repository all stored data  ]
* @var array $files        [ Repository all stored files ]
* @var mixed $item
* @var string $configPath
* @var string $group
*/
protected static $stored = [];
protected static $files = []; 
protected static $item;
protected static $configPath='';
protected static $group='';


/**
* set base path config
* @param string
* @return 
*/
public static function basePath(string $configPath='')
{
     self::$configPath = trim($configPath, '/');
     return new static;
}


/**
 * Load many files 
 * @return 
*/
public function map()
{
      $path = self::$configPath ."/*";
      foreach(glob($path) as $configPath)
      {
         if(is_file($configPath))
         {
            $infoFile = pathinfo($configPath);
            if($infoFile['extension'] === 'php')
            {
                $name = $infoFile['filename'];
                self::saveFile($name, $configPath);
            }
         }
      }

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
* Get config group or item
* @param string $parsed 
* ex: [Config::get(group)]      Load group
* ex: [Config::get(group.item)] Loaad item
* @return self
*/
public static function get($parsed='')
{
    return self::load($parsed);
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
 * Get all stored files
 * @return array
*/
public static function files()
{
    return self::$files;
}



/**
 * Determine if has group stored
 * @return bool
*/
public static function isStored()
{
     return !empty(self::$stored[self::$group]);
}



/**
 * Determine if has item
 * @param string $item 
 * @return bool
*/
public static function hasChild($item='')
{
    $finded = array_key_exists(
                self::$group, 
                self::$stored
            );
    if(!is_null($item))
    {
        $finded = array_key_exists($item, 
          self::$stored[self::$group]
        );
    }
    return $finded;
}



/**
 * Retrieve item
 * @param string $item 
 * @return mixed
*/
public static function retrieveItem($item='')
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
public static function retrieveGroup()
{
     return self::$stored[self::$group];
}



/**
 * Save data file in container
 * @param string $group
 * @param string $file
 * @return void
*/
public static function saveFile($group='', $file='')
{
   if($path = realpath($file))
   {
       if(!in_array($group, self::$stored))
       {
           self::store([$group => require($path)]);
       }
       self::addFile($path);
   }
}



/**
 * Add path
 * @param string $path 
 * @return string
*/
private static function addFile($path)
{
     if(!in_array($path, self::$files))
     {
          self::$files[] = $path;
     }
}


/**
* Load config group or item
* @param string $parsed 
* ex: [self::load(group)]      Load group
* ex: [self::load(group.item)] Loaad item
* @return self
*/
private static function load($parsed='')
{
   if($parsed)
   {
        self::$group = $parsed;
        self::$item = null;
        $exp = explode('.', $parsed);
        self::$group = $exp[0];
        self::$item  = $exp[1];
        if(self::$configPath !== '')
        {
            $file = self::$configPath . '/' . mb_strtolower(self::$group) . '.php';
           
            if(is_file($file))
            {
                self::saveFile(self::$group, $file);
            }
        }
        
        // retrieve group or item
        if(self::isStored())
        {
             // retrive part
             if(self::hasChild(self::$item))
             {
                  return self::retrieveItem(self::$item);
             }
        }
   }
}

}