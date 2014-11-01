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

//default
Route::get('/', 'HomeController@getIndex');
// users
Route::controller('users', 'UsersController');
Route::controller('kuulutused', 'PostsController');
Route::controller('kuulutus', 'KuulutusController');
//comments
//Route::controller('comments', 'CommentsController');
//tags
Route::controller('tags', 'TagsController');
//bookmarks
Route::controller('bookmarks', 'BookmarksController');
//Route::controller('lemmikud', 'BookmarksController');

// categories
//Route::controller('categories', 'CategoriesController');
//Route::controller('pay','PaymentsController');