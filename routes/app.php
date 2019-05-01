<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/



# SITE
Route::get('', 'HomeController@index', 'welcome.page');
Route::get('about', 'HomeController@about');



Route::get('contact', 'HomeController@contact');
Route::post('contact', 'HomeController@contact');



# ADMIN





# NOT FOUND
Route::get('/404', 'NotFoundController@index');
Route::notFound(404);


