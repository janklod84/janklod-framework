<?php 

use JK\Database\Migrations\{
	Column
};

function ptr($arr, $die=false)
{
	 echo '<pre>';
	 print_r($arr);
	 echo '</pre>';
	 if($die) die;
}

