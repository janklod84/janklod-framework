<?php 


if(!function_exists('debug'))
{
/**
 * Debug data 
 * @param mixed $parsed 
 * @param bool $die 
 * @return void
 */
function debug($parsed, $die = false)
{
 echo '<pre>';
 print_r($parsed);
 echo '</pre>';
 if($die) die;
    
}
}


if(!function_exists('dd'))
{
/**
 * Debug data with more precision [die and dump]
 * @param mixed $parsed 
 * @return void
*/
function dd($parsed)
{
 echo '<pre>';
 var_dump($parsed);
 echo '</pre>';
 die;
}
}