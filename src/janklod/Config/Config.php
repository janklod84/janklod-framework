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
* @param string $configPath
* @return self
*/
public static function basePath(string $configPath='')
{
     self::$configPath = trim($configPath, '/');
     return new static;
}


/**
* Load config group or item
* @param string $parsed 
* ex: [self::load(group)]      Load group
* ex: [self::load(group.item)] Loaad item
* @return self
*/
public static function load($parsed='')
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
        if(self::isStored(self::$group))
        {
             // retrive part
             if(self::hasChild(self::$group, self::$item))
             {
                  return self::retrieveItem(self::$group, self::$item);
             }
        }
   }
}


/**
 * Load many files 
 * @return void
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
 * @param string $group
 * @return bool
*/
public static function isStored($group)
{
     return ! empty(self::$stored[$group]);
}


/**
 * Get config group
 * @param string $name 
 * @return mixed
*/
public static function group($name)
{
    return self::retrieveGroup($name);
}


/**
 * Retrieve group
 * @param string $group
 * @return mixed
*/
public static function retrieveGroup($group)
{
    if(!self::isStored($group))
    {
        exit(
          sprintf('Sorry this [%s] config group does not stored!', $group)
        );
    }
    return self::$stored[$group];
}

/**
 * Determine if has item
 * @param string $group
 * @param string $item 
 * @return bool
*/
public static function hasChild($group='', $item='')
{
   return array_key_exists($item, self::$stored[$group]);
}



/**
 * Retrieve item
 * @param string $group
 * @param string $item 
 * @return mixed
*/
public static function retrieveItem($group, $item)
{
     if(!isset(self::$stored[$group][$item]))
     {
        exit(
          sprintf('Sorry can not retrieve item [%s] in group [%s]', $item, $group)
        );   
     }
     return self::$stored[$group][$item];
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


}