<?php 
namespace JK\Security\Authentication;



/**
 * @package JK\Security\Authentication\Auth
*/ 
class Auth
{
          
/**
 * @var   string   $key            [ Base key of Authentication]
 * @var   array    $permissions    [ Permissions ]
 * @var   array    $authenticates  [ Authenticates ]
 */
private static $key = 'auth.identify--'; // default
private static $permissions   = [];
private static $authenticates = [];


/**
 * Generate auth key
 * 
 * @param string $key 
 * @return string
 */
public static function generate($key='xxx-xxx-domain.com')
{
     // 
}

/**
 * Add Auth
 * 
 * @param array  $user
 * @param string $hash
 * @return void
*/
public static function add(array $user, $hash='')
{
     if($hash){ self::$key .= $hash; }
     self::$authenticates[self::$key] = $user;
}


/**
* Determine if current user is logged
* 
* @return bool
*/
public static function isLogged(): bool
{
	 return isset(self::$authenticates[self::$key]);
}


/**
 * Get current user
 * 
 * @param null $item 
 * @return mixed
*/
public static function current()
{
     if(!self::isLogged())
     {
     	 die('No Logged User!');
     }
     return self::$authenticates[self::$key];
}


/**
 * Add permission
 * 
 * @param  array $permissions 
 * @return void
*/
public static function addPermissions($permissions = [])
{
      self::$permissions = array_merge(
        self::$permissions, 
        $permissions
      );
}


/**
 * Add permission
 * 
 * @param string|array $permissions 
 * @return void
*/
public static function addPermission($name='admin', $value=1)
{
      self::$permissions[$name] = $value;
}


/**
 * Determine if current user has permissions
 * 
 * @param string $name 
 * @return bool
*/
public static function is($name='admin')
{
    $current = self::currentUser();
    if(in_array($name, array_values($current)))
    {
         return true;
    }
    if(is_object($current)) {}
    return false;
}

/**
 * Remove current authenticate
 * 
 * @return string
*/
public static function logout()
{
    if(self::isLogged())
    {
         unset(self::$authenticates[self::$key]);
         return true;
    }
    return false;
}

/**
 * Get all authenticated
 * 
 * @return array
*/
public static function authenticates()
{
    return self::$authenticates;
}     

/**
 * Get all permissions
 * 
 * @return array
*/
public static function permissions()
{
    return self::$permissions;
}     


}