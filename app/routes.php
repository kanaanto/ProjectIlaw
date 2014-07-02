<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/','UserController@login');
// Route::get('test', function(){

// 	return View::make('hello');

// });

//Route::resource("login","UserController");
Route::get("login","UserController@index");
Route::post("login","UserController@checklogin");
Route::get("home","HomeController@index");
Route::get("bulb/{bulb}","BulbsController@show");
Route::get("cluster/{cluster}","ClustersController@show");
