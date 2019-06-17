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

$prefixes = [
  // 'path' => '/admin',
  'controller' => 'admin'
];

Route::prefix($prefixes, function () {
    Route::get('/', function () {
         echo '<h1>Welcome to JK Framework</h1>';
    });
    Route::get('/sign-in', 'LoginController@index', 'sign.up');
    Route::get('/test', 'LoginController@test');
    Route::get('/dashboard', 'DashboardController@index');
    Route::post('/', 'LoginController@index');
});




Route::get('/me', function () {
   die('Me!');
});

/*
Route::get('/about', function () {
   die('About!');
});


Route::get('/about/:id', function () {
   die('About!');
})->with('id' => '[0-9]+');
*/

Route::get('/about/:id', function () {
   die('About!');
})->with(['id' => '[0-9]+']);


// Route::get('/test', function () {
//     die('ALREADY SETTED!');
// });


/***********************************
| FRONTEND CONTROLLERS
************************************/
