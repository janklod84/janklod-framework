<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/




/***********************************
| BACKEND CONTROLLERS
************************************/

$options = [
  // 'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($options, function () {
    Route::get('/login', 'UserController@login');
});


/* 
http://project.loc/admin/page/4 
echo url('page.admin', ['id' => 4]);
*/

/***********************************
| FRONTEND CONTROLLERS
************************************/


Route::get('/', 'HomeController@index', 'welcome.page');
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@contact');
Route::post('/contact', 'HomeController@contact');
Route::get('/test', function () {
   die('Привет ребята!');
});

