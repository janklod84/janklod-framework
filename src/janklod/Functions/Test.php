<?php 

use JK\Database\Migrations\{
	Column,
	BluePrint
};

function ptr($arr, $die=false)
{
	 echo '<pre>';
	 print_r($arr);
	 echo '</pre>';
	 if($die) die;
}

