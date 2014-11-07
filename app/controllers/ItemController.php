<?php

class ItemController extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Display a listing of the resource.
	 * GET /item
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return "item index";
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /item/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if ( Auth::guest() ) {
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		$this->layout->title = 'Add Item';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('item.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /item
	 *
	 * @return Response
	 */
	public function postCreate()
	{

		if ( Auth::guest() ) {
			return Redirect::to('/')->with('errormessage', Lang::get('text.please_log_in') );
		}

		return Input::get('public');

		$user_id = Auth::user()->id;
		$user = User::find($user_id);

		$validator = Validator::make(Input::all(), Item::$rules);

 		if ($validator->passes()) {

 			$item = new Item;
 			$item->paid = false;//vaja labimotelda
 			$item->public = ( Input::get('public') == 'on' ? true : false );
 			$item->type = Input::get('type');
 			$saveItem = $item->user()->associate($user)->save();

 			// othe fiels
 			$label = Input::get('label');
 			$address = Input::get('address');

 			if( $saveItem ) 
 			{
 				return "item has saved save next data";
 			} else {
 				return Redirect::to('users/register')->with('errormessage', 'The following errors occurred')->withErrors($validator)->withInput();
 			}
 			
		    return Redirect::to('/')->with('message', Lang::get('text.saved_successfully') );
		    
		} else {
		    return Redirect::to('item/create')->with('errormessage', 'The following errors occurred')->withErrors($validator)->withInput();
		}

	}

	/**
	 * Display the specified resource.
	 * GET /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return "item show" . $id;
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /item/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return "item edit" . $id;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return "item update" . $id;
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /item/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return "item destroy" . $id;
	}

}