<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE
$frontend = [
  'prefix' => [
   'controller' => 'site'
  ]
];

Route::group($frontend, function () {
   Route::get('', 'HomeController@index');
   Route::get('about', 'HomeController@about');
   Route::get('contact', 'HomeController@contact');
   Route::post('contact', 'HomeController@contact');
});


# ADMIN
$backend = [
 'prefix' => [
 	'path' => '/admin',
 	'controller' => 'admin'
 ]
];

Route::group($backend, function () {
    Route::package('', 'UserController');
});


# Test closure callback
Route::get('/test', function () {
   echo 'Welcome to Test page!';
});

Route::get('/login', function () {
   echo 'User::login';
});

Route::get('/logout', function () {
   echo 'User::logout';
});



# NOT FOUND
Route::get('/404', 'NotFoundController@index');
Route::notFound(404);
