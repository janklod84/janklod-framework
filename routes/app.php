<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE

Route::get('/', 'HomeController@index', 'welcome.page');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::post('/contact', 'HomeController@contact');


Route::get('/me', [
   'controller' => 'HomeController',
   'action' => 'me'
]);


Route::get('/test', function () {
    echo 'Привет друзья!';
}, 'test.page');



Route::get('/admin', function () {
    echo 'Привет админ';
});

Route::post('/admin/contact', function () {
    echo 'Contact admin';
});