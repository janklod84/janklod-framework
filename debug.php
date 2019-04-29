<?php 

function debug($parsed, $die = false)
{
	 echo '<pre>';
	 print_r($parsed);
	 echo '</pre>';
     if($die) die;
    
}


function dump($parsed, $die = false)
{
     echo '<pre>';
	 var_dump($parsed);
	 echo '</pre>';
     if($die) die;
}