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


//Route::get("home","HomeController@index");
//Route::get("bulb/{bulb}","BulbsController@show");
//Route::get("cluster/{cluster}","ClustersController@show");

Route::resource('cluster',"ClustersController");
Route::resource("home","HomeController");
Route::resource("bulb","BulbsController");
Route::resource("/","SessionsController");
Route::get("logout","SessionsController@destroy");
