<?php 
use JK\Helper\Register;

if(!function_exists('register'))
{
/**
 * Data Register 
 * @return void
*/
function register()
{
	return Register::instance();
}
}