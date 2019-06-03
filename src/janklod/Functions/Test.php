<?php 

use JK\Database\Migrations\{
	Column,
	BluePrint,
	Schema
};

function ptr($arr, $die=false)
{
	 echo '<pre>';
	 print_r($arr);
	 echo '</pre>';
	 if($die) die;
}


Schema::create('users', function (BluePrint $table) {

     ptr($table);
});