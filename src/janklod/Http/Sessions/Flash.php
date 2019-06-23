<?php 
namespace JK\Http\Sessions;


/**
 * @package JK\Http\Sessions\Flash
 */
class Flash 
{
        

/**
 * @var array 
*/
private static $messages;


/**
 * @var session key
*/ 
private static $sessionKey = 'session.flash';



/**
 * Set message for show user
 * @param string $key 
 * @param string $message 
 * @return string
 */
public static function message($key = '', $message = '')
{
	  Session::put($key, $message);
}

/**
* Obtain data from session
* @param string $key 
* @return mixed
*/
public static function check($key)
{
    return Session::get($key);
}

        
/**
* Get Flash output to HTML format
* It's momentaly resolver it's will great after
* 
* @param type $key 
* @param type|string $class 
* @return type
*/
public static function show($key, $class = 'flash-default', $surround='div')
{
	if(Session::has($key))
	{
		$html  = sprintf('<%s class="%s">', $surround, $class);
		$html .= self::check($key);
		$html .= sprintf('</%s>', $surround);
		Session::remove($key);
		return $html;
	}
}
}