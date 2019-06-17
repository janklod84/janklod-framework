<?php

/*
 * Developer   :    Jean - Claude
 * PHP version :    >= 7.1 (Current 7.2.11)
 * Project     :    v.1.0
 * Systeme     :    Cache Navigateur
*/

require_once __DIR__.'/func.php';

$file = __FILE__;
$last_modified_time = filemtime($file);
$etag = md5($last_modified_time);


// Entete de derniere modification
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . " GMT");
header("Etag: $etag");
// header("test: Test");


if( 
   (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) 
   && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) === $last_modified_time)
   || (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $etag === trim($_SERVER['HTTP_IF_NONE_MATCH']))
)
{
     header("HTTP/1.1 304 Not Modified");
     exit();
}



sleep(4);
echo time();
dd($_SERVER);