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
    Route::get('/test', 'LoginController@test');
    Route::post('/', 'LoginController@index');
    Route::get('/dashboard', 'DashboardController@index');
});


/*
Route::get('/me', function () {
   die('Hi, Friends!');
});
*/


/***********************************
| FRONTEND CONTROLLERS
************************************/
