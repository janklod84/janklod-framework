<?php 
/*
  |------------------------------------------------------------------
  |         WEB ROUTES OF APPLICATION
  |         In this file you can register all lists routes
  |------------------------------------------------------------------
*/

# SITE

Route::get('', 'HomeController@index');
Route::get('about', 'HomeController@about');
Route::get('contact', 'HomeController@contact');
Route::post('contact', 'HomeController@contact');