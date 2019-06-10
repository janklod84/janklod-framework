<?php 

return [
     
/*
|------------------------------------------------------------------
|     CONNECTION TO DATABASE [ avalaibles drivers mysql, sqlite ]
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
    'driver'    => 'mysql',
    'dbname'    => 'dbproject',
    'host'      => 'localhost',
    'port'      => '3306',
    'charset'   => 'utf8',
    'collation' => 'utf8mb4',
    'username'  => 'root',
    'password'  => 'root',
    'options'   => [],
    'prefix'    => '',
    'engine'    => null
 ]

];

