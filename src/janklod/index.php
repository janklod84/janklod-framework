<?php 


$cache = $this->app->file->cache('cache/app');




$cache->set('fname', 'Jean')
      ->set('lname', 'Kouassi')
      ->set('email', 'jeanyao@ymail.com');

echo ' First Name: ' . $cache->get('fname') . 
     ' Last Name: ' . $cache->get('lname') . 
     ' Email: ' . $cache->get('email');