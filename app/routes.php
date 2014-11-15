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

// item
Route::controller('item', 'ItemController');

// password reminder
Route::controller('password', 'RemindersController');

// email
Route::controller('email', 'SendEmail');

// comments
Route::controller('comments', 'CommentsController');

// admin
Route::controller('admin','AdminController');

// votes
Route::controller('vote','VotesController');
