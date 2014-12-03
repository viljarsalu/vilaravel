<?php

class HelloController extends \BaseController {

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
		//
		$this->layout->title = 'tere tulemast!';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('home');
	}

	// upload picture
	public function getUpload()
	{
		$this->layout->title = 'tere tulemast!';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('item.upload.picture');
	}
	public function postUpload()
	{
		/*$pic = Input::file('picture');
		$picture_name = $pic->getClientOriginalName();
		$pic->move('imagesTEST',$picture_name);

		$pic_final = 'images/'.$picture_name;


		return "original name:" . $picture_name;*/

			$file 	= Input::file('picture');
			$path 	= public_path() . '/uploads';

			$uploadedFile = Image::upload($file,$path,false);
			$thumb 	= Image::thumb($uploadedFile, 200, 200);
			//$medium = Image::resize($uploadedFile, 600);
			$large 	= Image::resize($uploadedFile, 800);

			return $path . ' ' . $file->getClientOriginalName();
		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /hello/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /hello
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /hello/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /hello/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /hello/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /hello/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}