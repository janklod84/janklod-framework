<?php 

if(!function_exists('config')) 
{ 
     
	/**
	 * Get config
	 * @param string $parsed
	 * @return mixed
	*/
	function config($parsed='')
	{
		$group = Config::group($parsed);
		if(!Config::isStored($parsed))
		{
            if(strpos($parsed, '.') !== false)
            {
            	 $explode = explode($parsed, '.');
            	 return $group[$explode[1]] ?? null;
            }
		}
		return $group;
	}
}
