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
		//return App::environment();
		$pageData = [];
		$item = Item::where('public','=',1)->get();
		foreach ($item as $key => $value) {
			echo $value->plansandprices;
			array_push($pageData, $value);
		}
		echo '<hr />' . Item::find(1)->labels;
		echo '<hr />' . Item::find(7)->plansandprices;
		return 'end';

		$this->layout->title = 'Items';
	   	$this->layout->metaDescription = Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords = Lang::get('text.keywords') . ' ';
	   	$this->layout->content = View::make('items.show');
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
