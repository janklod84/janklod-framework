<?php 
namespace JK\Foundation\Runners;

/**
 * @package JK\Foundation\Runners\AliasRunner 
*/ 
class AliasRunner extends CustomRunner 
{


/**
* 
* @return void
*/
public function init()
{
	foreach(self::get('alias') as $alias => $classname)
	{
	   if(class_exists($classname))
	   {
	        if(class_alias($classname, $alias))
	        {
	            self::$initialized['alias'][] = compact('classname', 'alias');
	        }
	   }
	}
}


}