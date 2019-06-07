<?php 

return [
     
/*
|------------------------------------------------------------------
|     CONNECTION TO DATABASE
|------------------------------------------------------------------
*/

'sqlite' => [
   'driver'   => 'sqlite',
   'dbname'   => '../test.db',	 
   'options'  => [],
   'prefix'   => ''
 ],
 'mysql' => [
    'driver'   => 'mysql',
    'dbname'   => 'mysql_db',
    'host'     => 'localhost',
    'port'     => '3306',
    'charset'  => 'utf-8',
    'collation' => '',
    'username' => 'root',
    'password' => 'xx-secret-xxx',
    'options'  => [],
    'prefix'   => '',
    'engine'   => null
 ];

];