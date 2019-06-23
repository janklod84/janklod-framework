<?php 
namespace JK\Security\Authentication;

/**
 * @package JK\Security\Authentication\AuthInterface 
*/ 
interface AuthInterface 
{
	/**
	 * Determine if current user authenticated
	 * @retrun bool
	*/
	public static function isLogged(): bool;
	
	/**
	 * Determine if current user has permission
	 *
	 * @param string $key 
	 * @return bool 
	*/
	// public static function has($key): bool;
}