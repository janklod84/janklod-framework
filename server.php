<?php 
/*
|----------------------------------------------------------------------
|   Stimulate Server Interne
|   Run command : 
|   php -S localhost:<port[ex : 8000 ]> -t public -d display_errors=1 server.php
|   and test application in your browser
|----------------------------------------------------------------------
*/

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


if ($url !== '/' && file_exists(__DIR__.'/public'.$url)) {
    return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once realpath(__DIR__.'/public/index.php');