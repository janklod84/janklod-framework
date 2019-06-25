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


// $prefixes = [
//   'prefix' => '/dashboard', // admin,
//   'namespace' => 'admin'
// ];

// Route::prefix($prefixes, function () {
//     Route::get('/', 'DashboardController@index');
// });


/***********************************
| FRONTEND CONTROLLERS
************************************/
$prefixes = [
  'namespace' => 'blog'
];

Route::prefix($prefixes, function () {
    Route::get('/', 'PostController@index', 'home');

    Route::get('/blog/category/:slug-:id', 'CategoryController@show', 'category')
    ->with(['slug' => '[a-z\-]+', 'id'   => '[0-9]+']);

    Route::get('/blog/:slug-:id', 'PostController@show', 'post')
    ->with(['slug' => '[a-z\-]+', 'id'   => '[0-9]+']);
    
    Route::get('/login', 'UserController@login');
	  Route::post('/login', 'UserController@login');
    Route::get('/register', 'UserController@register');
	  Route::post('/register', 'UserController@register');
    Route::get('/profile', 'UserController@profile', 'profile');

    Route::get('/logout', 'UserController@logout');
});



Route::get('/welcome', function () {
  echo 'Привет друзья!';
});


// Test Route
/*
Route::get('/test/:slug-:id', function ($slug, $id) {
    echo 'Slug: '. $slug .' -- ID: '. $id;
}, 'test')->with(['slug' => '[a-z\-]+', 'id' => '[0-9]+']);
*/