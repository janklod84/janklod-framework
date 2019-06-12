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
    Route::get('/', 'LoginController@index', 'sign.up');
    Route::post('/', 'LoginController@index');
    Route::get('/test', 'LoginController@test');
    Route::get('/dashboard', 'DashboardController@index');
});



Route::get('/me', function () {
   die('Me!');
});


Route::get('/about', function () {
   die('About!');
});


// Route::get('/test', function () {
//     die('ALREADY SETTED!');
// });


/***********************************
| FRONTEND CONTROLLERS
************************************/
