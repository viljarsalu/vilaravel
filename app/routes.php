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

// home
Route::get('/', 'HomeController@getIndex');

// users
Route::controller('users', 'UsersController');

// items
Route::controller('items', 'ItemsController');

// password reminder
Route::controller('password', 'RemindersController');

// email
Route::controller('email', 'SendEmail');
