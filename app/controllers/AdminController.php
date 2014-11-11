<?php

class AdminController extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return "admin index";
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/create
	 *
	 * @return Response
	 */
	public function getCreatelabel()
	{
		if ( Auth::guest() ) {
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$this->layout->title = 'Create label';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('admin.createlabel');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin
	 *
	 * @return Response
	 */
	public function postCreatelabel()
	{
		$label 			= new Label;
 		$label->public 	= ( Input::get('public') == "on" ? true : false );
 		$label->title 	= Input::get('title');

 		if( $label->save() )
 		{
 			return Redirect::to('/admin/createlabel')->with('message', Lang::get('text.saved') );
 		} else {
 			return Redirect::to('/admin/createlabel')->with('errormessage', Lang::get('text.saving_error') );
 		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/createplanandprice
	 *
	 * @return Response
	 */
	public function getCreateplanandprice()
	{
		if ( Auth::guest() ) {
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$this->layout->title = 'Create label';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('admin.createplanandprice');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/createplanandprice
	 *
	 * @return Response
	 */
	public function postCreateplanandprice()
	{
		$planandprice				= new Price;
 		$planandprice->public 		= ( Input::get('public') == "on" ? true : false );
 		$planandprice->title 		= Input::get('title');
 		$planandprice->description 	= Input::get('description');
 		$planandprice->price 		= Input::get('price');
 		$planandprice->date_start 	= new DateTime;//Input::get('date_start');
 		$planandprice->date_end 	= new DateTime;//Input::get('date_end');

 		if( $planandprice->save() )
 		{
 			return Redirect::to('/admin/createplanandprice')->with('message', Lang::get('text.saved') );
 		} else {
 			return Redirect::to('/admin/createplanandprice')->with('errormessage', Lang::get('text.saving_error') );
 		}
	}



	/**
	 * Display the specified resource.
	 * GET /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getUpdate($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		//
	}

}