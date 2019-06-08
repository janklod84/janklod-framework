<?php 
namespace JK\Console;

/**
 * Command Register [ Chain commands ]
 * @package JK\Console\Command 
*/ 
class Command
{


/**
 * @var array $commands
*/
private static $commands = [];


/**
 * Add command
 * @param CommandInterface $command 
 * @param string $name
 * @param array $options
 * @return void
*/
public static function add(
CommandInterface $command, 
$name = null, 
$options = []
)
{
   if(!is_null($name))
   {
   	  self::$commands[$name] = $command;
   }
   
   $command->setOptions($options);
}


/**
 * Determine if has command
 * @param string $name
 * @return bool
*/
public static function has($name)
{
	return isset(self::$commands[$name]);
}

/**
 * Get setted command
 * @param string $name
 * @return \JK\Console\CommandInterface
*/
public static function get($name): CommandInterface
{
	 if(!self::has($name))
	 {
         exit(
           sprintf('Sorry this command [%s] does not isset!', $name)
         );
	 }
	 return self::$commands[$name];
}

/**
 * Get all registred command
 * @return array
*/
public static function all()
{
	return self::$commands;
}


}