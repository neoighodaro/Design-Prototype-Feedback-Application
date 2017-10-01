<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/feedback/{image_url}/comment', 'PhotoController@comment');
Route::get('/feedback/{image_url}', 'PhotoController@show');
Route::post('/upload', 'PhotoController@upload');
Route::view('/', 'welcome');
