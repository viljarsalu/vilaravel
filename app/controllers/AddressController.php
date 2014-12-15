<?php

class AddressController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return Input::all();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		return Input::all();
		// Attach address to Item
		$plansPrices = Price::find($price_id);
		$item->prices()->attach($plansPrices->id);
		// Attach address to user
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
	public function getChange($id)
	{
		$user = User::find($id);
		$addresses = $user->addresses;
		echo 'sdfsadfas';
		return $addresses;

		$this->layout->title 			= 'Item';
	   	$this->layout->metaDescription 	= Lang::get('text.meta_content') . ' ';
	   	$this->layout->metaKeywords 	= Lang::get('text.keywords') . ' ';
	   	$this->layout->content 			= View::make('address.show', array('addresses' => $addresses) );
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
