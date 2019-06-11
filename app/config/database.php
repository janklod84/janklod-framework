<?php 

return [
     
/*
|------------------------------------------------------------------
|     CONNECTION TO DATABASE 
|     [ avalaibles drivers mysql, sqlite ]
|------------------------------------------------------------------
*/

'connection' => 'mysql', // drivers [ mysql, sqlite, ...]
'sqlite' => [
   'dbname'   => '../test.sqlite',	 
   'options'  => [],
   'prefix'   => ''
 ],
 'mysql' => [
    'dbname'    => 'dbproject',
    'host'      => 'localhost',
    'port'      => '3306',
    'charset'   => 'utf8',
    'username'  => 'root',
    'password'  => 'root',
    'collation' => 'utf8mb4',
    'options'   => [],
    'prefix'    => '',
    'engine'    => null
 ]

];

