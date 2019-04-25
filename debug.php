<?php 

function debug($parsed, $die = true)
{
	 echo '<pre>';
	 print_r($parsed);
	 echo '</pre>';
     if($die) die;
    
}


function dump($parsed, $die = true)
{
     echo '<pre>';
	 var_dump($parsed);
	 echo '</pre>';
     if($die) die;
}