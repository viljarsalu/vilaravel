<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.main';
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
	    $this->layout->title = 'tere tulemast!';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('home');
	}
}
