<?php

class ItemsController extends \BaseController {

	protected $layout = 'layouts.main';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//$items = Item::with('content','labels')->get();
		//$items = Item::with('content','labels')->where('public','=',1)->get();
		/*$type = 'type';
		$items = Item::with('content','labels')->where('type','LIKE','%'.$type.'%')->get();
		return $items;*/

		/*$labels = Label::with('items')->where('public','=',1)->get();
		return $labels;*/
		//return 'end';
		$t 	= Helper::helloWorld();
		$d 	= Helper::get_time_ago(strtotime('now'));
		//return "test". $d;

		$items = Item::with('content','comments','votes','votedusers','labels','assets')->where('public','=',1)->orderBy('created_at','DESC')->get();
		//return $items;

		$this->layout->title 			= 'Items';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('items.show', array('items' => $items) );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
