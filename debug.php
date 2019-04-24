<?php 

function debug($parsed, $die = true)
{
	 echo '<pre>';
	 print_r($parsed);
	 echo '</pre>';
    if($die) die;
    
}