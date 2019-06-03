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
    Route::get('/', 'LoginController@index');
});

/***********************************
| FRONTEND CONTROLLERS
************************************/
