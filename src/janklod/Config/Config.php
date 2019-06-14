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
* @var string $configPath  [ Base path configs ]
*/
protected static $stored = [];
protected static $files  = []; 
protected static $configPath='';


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
* Store configuration
* @param array $data 
* @return void
*/
public static function store($data=[])
{
    self::$stored = array_merge(self::$stored, $data);
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
* Load config tem
* Ex:
* Config::get('group.item')  Load item
* 
* @param string $parsed 
* @return self
*/
public static function load($parsed='')
{
   if($parsed)
   {
        $exp = explode('.', $parsed);
        $group = $exp[0] ?? '';
        $item  = $exp[1] ?? '';
        self::saveFile($group);
    
        // retrieve group or item
        if(self::isStored($group))
        {
             // retrive part
             if(self::hasChild($group, $item))
             {
                  return self::retrieveItem($group, $item);
             }
        }
   }
}


/**
 * Save data file in container by filename [ group ]
 * 
 * Config::saveFile('app')
 * 
 * @param string $group
 * @return void
*/
public static function saveFile($group)
{
    if(self::$configPath !== '')
    {
        $file = self::$configPath . '/' . mb_strtolower($group) . '.php';
       
        if($path = realpath($file))
        {
             if(!in_array($group, self::$stored))
             {
                 self::store([$group => require($path)]);
             }
             self::addFile($path);
        }
    }
   
}

/**
* Get config item
* 
* Ex:
* Config::get('asset.css')  Loaad item
* 
* @param string $parsed 
* @return self
*/
public static function get($parsed='')
{
    return self::load($parsed);
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
public static function hasChild($group, $item)
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