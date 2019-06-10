<?php 

return [
     
/*
|------------------------------------------------------------------
|     CONNECTION TO DATABASE
|------------------------------------------------------------------
*/

'connection' => 'mysql', // mysql, sqlite, ...
'sqlite' => [
   'driver'   => 'sqlite',
   'dbname'   => '../test.sqlite',	 
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
 ]

];

