<?php 
namespace JK\Foundation;

/**
 * @package JK\Foundation\RunnerRegister
*/
class RunnerRegister
{

    
/**
 * Runners
*/
private static $runners = [
 \JK\Foundation\Runners\AliasRunner::class,
 \JK\Foundation\Runners\ProviderRunner::class,
 \JK\Foundation\Runners\FunctionRunner::class 
];


/**
* Add runners
* @param string $name 
* @return void
*/
public static function add($name)
{
   self::$runners[] = $name;
}


/**
 * Get all runners
 * @return array
*/
public static function all()
{
	return self::$runners;
}

}