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
  'path' => '/dashboard', // admin,
  'controller' => 'admin'
];

Route::prefix($prefixes, function () {
    Route::get('/', 'DashboardController@index');
});


/***********************************
| FRONTEND CONTROLLERS
************************************/
$prefixes = [
  'controller' => 'blog'
];

Route::prefix($prefixes, function () {
    Route::get('/', 'PostController@index', 'home');
    Route::get('/blog/category/:slug-:id', 'CategoryController@show', 'category')
    ->with([
       'slug' => '[a-z\-]+',
       'id'   => '[0-9]+'
    ]);
    Route::get('/blog/:slug-:id', 'PostController@show', 'post')
    ->with([
       'slug' => '[a-z\-]+',
       'id'   => '[0-9]+'
    ]);
});


Route::get('/test/:slug-:id', function ($slug, $id) {
    echo 'Slug: '. $slug .' -- ID: '. $id;
}, 'category')->with(['slug' => '[a-z\-]+', 'id'   => '[0-9]+']);