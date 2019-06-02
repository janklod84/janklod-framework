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
  'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($options, function () {
    Route::get('/page/:id', 'UserController@login', 'page.admin')
    ->with('id', '[0-9]+');
    Route::get('/login', 'UserController@login'); // admin/login
    Route::get('/test', 'UserController@test'); // admin/test
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
   die('Привет друзья!');
});


/***********************************
| NOT FOUND CONTROLLER
************************************/

Route::get('/404', 'NotFoundController@index');
