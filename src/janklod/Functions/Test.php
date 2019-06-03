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


Schema::create('users', function(BluePrint $table) {

     $table->string('username');
     ptr($table);
});

/*
JK\Database\Migrations\BluePrint Object
(
    [table] => users
    [primary] => 
    [columns] => Array
        (
            [0] => JK\Database\Migrations\Column Object
                (
                    [name] => username
                    [type] => varchar
                    [length] => 200
                    [default] => 
                    [comments] => Array
                        (
                        )

                    [nullable] => 
                    [index] => primary
                    [collation] => utf8_general_ci
                    [autoincrement] => 
                )

        )

)

CREATE TABLE IF NOT EXISTS `users` (`username` varchar(200) DEFAULT "")
*/