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

$bluePrint = new BluePrint('users');

$bluePrint->increments('id');
$bluePrint->string('username');
$bluePrint->integer('role');
ptr($bluePrint);

/*
JK\Database\Migrations\BluePrint Object
(
    [table] => users
    [primary] => id
    [columns] => Array
        (
            [0] => JK\Database\Migrations\Column Object
                (
                    [name] => id
                    [type] => int
                    [length] => 11
                    [default] => 
                    [comments] => Array
                        (
                        )

                    [nullable] => 
                    [index] => primary
                    [collation] => utf8_general_ci
                    [autoincrement] => 1
                )

            [1] => JK\Database\Migrations\Column Object
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

            [2] => JK\Database\Migrations\Column Object
                (
                    [name] => role
                    [type] => int
                    [length] => 11
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
*/